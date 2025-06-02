<?php

namespace giftbox\webui\actions;

use giftbox\application_core\domain\entities\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class GetCategorieByIdAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;

        if ($id === null) {
            throw new HttpBadRequestException($rq, 'ID de catégorie manquant');
        }

        $cat = Categorie::find($id);
        if (!$cat) {
            throw new HttpNotFoundException($rq, 'Catégorie non trouvée');
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categorie.twig', ['categorie' => $cat]);
    }
}