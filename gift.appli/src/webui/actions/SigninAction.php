<?php

namespace giftbox\webui\actions;

use giftbox\application_core\application\providers\AuthProviderInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class SigninAction
{
    private AuthProviderInterface $authProvider;

    public function __construct(AuthProviderInterface $authProvider) {
        $this->authProvider = $authProvider;
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $view = Twig::fromRequest($rq);

        if ($rq->getMethod() === 'GET') {
            return $view->render($rs, 'signin.twig');
        }

        $data = $rq->getParsedBody();
        $userId = $data['user_id'] ?? '';
        $password = $data['password'] ?? '';

        if (!$this->authProvider->signin($userId, $password)) {
            return $view->render($rs, 'signin.twig', ['error' => 'Identifiants invalides']);
        }

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        return $rs->withHeader('Location', $routeParser->urlFor('home'))->withStatus(302);
    }
}
