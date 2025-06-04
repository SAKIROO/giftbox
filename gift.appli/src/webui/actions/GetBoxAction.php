<?php

namespace giftbox\webui\actions;

use giftbox\application_core\application\useCases\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetBoxAction extends AbstractAction {
    private BoxService $service;

    public function __construct(BoxService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $view = Twig::fromRequest($rq);
        $boxId = $args['id'] ?? null;
        if (!$boxId) {
            throw new HttpNotFoundException($rq, "ID de box manquant");
        }

        $box = $this->service->getBoxById($boxId);
        return $view->render($rs, 'box_detail.twig', ['box' => $box]);
    }
}
