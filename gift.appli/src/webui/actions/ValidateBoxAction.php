<?php

namespace giftbox\webui\actions;

use giftbox\application_core\application\useCases\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;

class ValidateBoxAction extends AbstractAction {
    private BoxService $service;

    public function __construct(BoxService $service) {
        $this->service = $service;
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $boxId = $args['id'] ?? null;
        if (!$boxId) {
            throw new HttpBadRequestException($rq, "ID de box manquant");
        }

        $this->service->validateBox($boxId);
        return $rs
            ->withHeader('Location', '/box/' . $boxId)
            ->withStatus(302);
    }
}
