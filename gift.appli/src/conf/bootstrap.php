<?php

use giftbox\infrastructure\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

Eloquent::init(__DIR__ . '/gift.db.conf.ini');

$twig = Twig::create(__DIR__ . '/../webui/views', ['cache' => false]);

$app->add(TwigMiddleware::create($app, $twig));

$twig->getEnvironment()->addGlobal('routeParser', $app->getRouteCollector()->getRouteParser());
(require_once __DIR__ . '/routes.php')($app);

return $app;