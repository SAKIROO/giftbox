<?php
declare(strict_types=1);

use giftbox\webui\actions\GetCategorieByIdAction;
use giftbox\webui\actions\GetCategoriesAction;
use giftbox\webui\actions\GetDetailCoffretAction;
use giftbox\webui\actions\GetListeCoffretsAction;
use giftbox\webui\actions\GetPrestationAction;
use giftbox\webui\actions\HomeAction;
use Slim\App;


return function (App $app) : App {
    $app->get('/', HomeAction::class);
    $app->get('/categories', GetCategoriesAction::class)->setName('categories');
    $app->get('/categorie/{id}', GetCategorieByIdAction::class)->setName('categorie');
    $app->get('/prestation', GetPrestationAction::class)->setName('prestation');
    $app->get('/coffrets', GetListeCoffretsAction::class)->setName('coffrets');
    $app->get('/coffret/{id}', GetDetailCoffretAction::class)->setName('coffret');

    return $app;
};