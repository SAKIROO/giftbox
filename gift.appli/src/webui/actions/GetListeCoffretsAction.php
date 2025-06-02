<?php
namespace gift\appli\controlers;

use gift\appli\models\CoffretType;
use gift\appli\models\Theme;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetListeCoffretsAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $themes = Theme::with('coffrets')->get();
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'liste_coffrets.twig', ['themes' => $themes]);
    }
}
