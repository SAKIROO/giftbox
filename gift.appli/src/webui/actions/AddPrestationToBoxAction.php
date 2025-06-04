<?php

namespace giftbox\webui\actions;

use giftbox\application_core\application\useCases\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Views\Twig;

class AddPrestationToBoxAction extends AbstractAction {
    private BoxService $service;

    public function __construct(BoxService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $view = Twig::fromRequest($rq);
        $boxId = $args['id'] ?? null;

        if ($rq->getMethod() === 'GET') {
            $box = $this->service->getBoxById($boxId);
            return $view->render($rs, 'box_add_prestation.twig', ['box' => $box]);
        }

        $data = $rq->getParsedBody();
        if (empty($data['prestation_id']) || empty($data['quantite'])) {
            throw new HttpBadRequestException($rq, "Paramètres manquants");
        }

        try {
            $this->service->addPrestationToBox($boxId, $data['prestation_id'], (int)$data['quantite']);
            return $rs
                ->withHeader('Location', '/box/' . $boxId)
                ->withStatus(302);
        } catch (\Exception $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}
