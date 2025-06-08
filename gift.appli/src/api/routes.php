<?php

use giftbox\api\actions\GetAllPrestationsApiAction;
use giftbox\api\actions\GetBoxByIdApiAction;
use giftbox\api\actions\GetCategoriesApiAction;
use giftbox\api\actions\GetPrestationsByCategorieApiAction;
use Slim\App;

return function (App $app): App {
    $app->get('/api/categories', GetCategoriesApiAction::class);
    $app->get('/api/boxes/{id}', GetBoxByIdApiAction::class);
    $app->get('/api/prestations', GetAllPrestationsApiAction::class);
    $app->get('/api/categories/{id}/prestations', GetPrestationsByCategorieApiAction::class);

    return $app ;
};
