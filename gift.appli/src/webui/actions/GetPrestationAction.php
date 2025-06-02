<?php

namespace giftbox\webui\actions;

use giftbox\application_core\domain\entities\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class GetPrestationAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $rq->getQueryParams()['id'] ?? null;

        if (is_null($id)) {
            throw new HttpBadRequestException($rq, 'ID de prestation manquant');
        }

        $prestation = Prestation::find($id);
        if (!$prestation) {
            throw new HttpNotFoundException($rq, 'Prestation non trouvée');
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation.twig', ['prestation' => $prestation]);
    }
}