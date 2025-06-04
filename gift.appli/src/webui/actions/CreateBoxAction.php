<?php

namespace giftbox\webui\actions;

use giftbox\application_core\application\useCases\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Views\Twig;

class CreateBoxAction extends AbstractAction {
    private BoxService $service;

    public function __construct(BoxService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $view = Twig::fromRequest($rq);

        if ($rq->getMethod() === 'GET') {
            return $view->render($rs, 'box_create.twig');
        }

        $data = $rq->getParsedBody();
        if (empty($data['libelle']) || empty($data['description'])) {
            throw new HttpBadRequestException($rq, "Paramètres manquants");
        }

        try {
            $data['createur_id'] = 1; // Utilisateur fictif
            $data['token'] = bin2hex(random_bytes(16)); // Génération d'un token aléatoire
            $box = $this->service->createBox($data);
            return $rs
                ->withHeader('Location', '/box/' . $box['id'])
                ->withStatus(302);
        } catch (\Exception $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}
