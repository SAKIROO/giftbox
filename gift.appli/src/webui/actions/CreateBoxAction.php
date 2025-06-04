<?php

namespace giftbox\webui\actions;

use giftbox\application_core\application\providers\CsrfTokenProvider;
use giftbox\application_core\application\useCases\BoxService;
use giftbox\application_core\domain\exceptions\CsrfException;
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
            $csrf = CsrfTokenProvider::generate();
            return $view->render($rs, 'box_create.twig', [
                'csrf' => $csrf
            ]);
        }

        $data = $rq->getParsedBody();

        try {
            CsrfTokenProvider::check($data['csrf'] ?? null);
        } catch (CsrfException $e) {
            throw new HttpBadRequestException($rq, 'CSRF token erreur');
        }

        if (empty($data['libelle']) || empty($data['description'])) {
            throw new HttpBadRequestException($rq, "Paramètres manquants");
        }

        try {
            $data['createur_id'] = 1;
            $data['token'] = bin2hex(random_bytes(16));
            $box = $this->service->createBox($data);
            return $rs
                ->withHeader('Location', '/box/' . $box['id'])
                ->withStatus(302);
        } catch (\Exception $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}
