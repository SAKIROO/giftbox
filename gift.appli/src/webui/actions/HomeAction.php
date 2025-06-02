<?php

namespace giftbox\webui\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class HomeAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'home.twig');
    }
}
