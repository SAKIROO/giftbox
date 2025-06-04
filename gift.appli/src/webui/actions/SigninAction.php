<?php

namespace giftbox\webui\actions;

use giftbox\application_core\application\providers\AuthProviderInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Routing\RouteContext;

class SigninAction
{
    private AuthProviderInterface $authProvider;

    public function __construct(AuthProviderInterface $authProvider)
    {
        $this->authProvider = $authProvider;
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $view = Twig::fromRequest($rq);

        if ($rq->getMethod() === 'GET') {
            return $view->render($rs, 'signin.twig');
        }

        $data = $rq->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $error = null;

        if (!$this->authProvider->signin($email, $password)) {
            $error = "Email ou mot de passe incorrect.";
        }

        if ($error) {
            return $view->render($rs, 'signin.twig', ['error' => $error]);
        }

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        return $rs
            ->withHeader('Location', $routeParser->urlFor('home'))
            ->withStatus(302);
    }
}
