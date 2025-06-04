<?php
declare(strict_types=1);

use giftbox\webui\actions\GetAllPrestationsAction;
use giftbox\webui\actions\GetCategoriesAction;
use giftbox\webui\actions\GetCategorieByIdAction;
use giftbox\webui\actions\GetDetailCoffretAction;
use giftbox\webui\actions\GetListeCoffretsAction;
use giftbox\webui\actions\GetPrestationAction;
use giftbox\webui\actions\HomeAction;
use giftbox\webui\actions\CreateBoxAction;
use giftbox\webui\actions\AddPrestationToBoxAction;
use giftbox\webui\actions\GetBoxAction;
use giftbox\webui\actions\ValidateBoxAction;
use Slim\App;


return function (App $app) : App {
    $app->get('/', HomeAction::class);
    $app->get('/categories', GetCategoriesAction::class)->setName('categories');
    $app->get('/categorie/{id}', GetCategorieByIdAction::class)->setName('categorie');
    $app->get('/prestation', GetPrestationAction::class)->setName('prestation');
    $app->get('/coffrets', GetListeCoffretsAction::class)->setName('coffrets');
    $app->get('/coffret/{id}', GetDetailCoffretAction::class)->setName('coffret');
    $app->get('/prestations', GetAllPrestationsAction::class)->setName('prestations');
    $app->map(['GET', 'POST'], '/box', CreateBoxAction::class);
    $app->map(['GET', 'POST'], '/box/{id}/add', AddPrestationToBoxAction::class);
    $app->get('/box/{id}', GetBoxAction::class);
    $app->post('/box/{id}/validate', ValidateBoxAction::class);

    return $app;
};