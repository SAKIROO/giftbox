<?php

namespace giftbox\webui\actions;

use giftbox\application_core\domain\entities\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetAllPrestationsAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $prestations = Prestation::all();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'liste_prestations.twig', [
            'prestations' => $prestations
        ]);
    }
}
