<?php

use DI\Container;
use giftbox\application_core\application\providers\AuthProviderInterface;
use giftbox\application_core\application\providers\SessionAuthProvider;
use giftbox\application_core\application\useCases\AuthnService;
use giftbox\application_core\application\useCases\AuthnServiceInterface;
use giftbox\application_core\domain\repositories\UserRepositoryInterface;
use giftbox\infrastructure\Eloquent;
use giftbox\infrastructure\EloquentUserRepository;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Psr\Container\ContainerInterface;
use giftbox\application_core\application\useCases\BoxService;

$container = new Container();
AppFactory::setContainer($container);

$container->set(UserRepositoryInterface::class, function() {
    return new EloquentUserRepository();
});

$container->set(AuthnServiceInterface::class, function($c) {
    return new AuthnService($c->get(UserRepositoryInterface::class));
});

$container->set(AuthProviderInterface::class, function($c) {
    return new SessionAuthProvider(
        $c->get(AuthnServiceInterface::class),
        $c->get(UserRepositoryInterface::class));
});

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

Eloquent::init(__DIR__ . '/gift.db.conf.ini');

$app->get('/style.css', function ($request, $response) {
    $response->getBody()->write(file_get_contents(__DIR__ . '/../webui/views/style.css'));
    return $response->withHeader('Content-Type', 'text/css');
});

$twig = Twig::create(__DIR__ . '/../webui/views', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));
$twig->getEnvironment()->addGlobal('routeParser', $app->getRouteCollector()->getRouteParser());


(require_once __DIR__ . '/routes.php')($app);
(require_once __DIR__ . '/../api/routes.php')($app);

    return $app;
