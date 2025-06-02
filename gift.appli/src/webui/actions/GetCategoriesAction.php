<?php

namespace gift\appli\controlers;

use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetCategoriesAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {

        $categories = Categorie::all();

        $view = Twig::fromRequest($rq);

        return $view->render($rs, 'listCategories.twig', ['categories' => $categories]);
    }
}