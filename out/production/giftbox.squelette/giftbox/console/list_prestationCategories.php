<?php

require_once __DIR__ . '/../vendor/autoload.php';

use giftbox\application_core\domain\entities\Prestation;
use giftbox\infrastructure\Eloquent;

Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini');

/*$
V1 :
prestations = Prestation::all();


foreach ($prestations as $prestation) {
    echo "Libellé prestation: {$prestation->libelle}\n";
    echo "Catégorie: {$prestation->categorie->libelle}\n";
    echo "Tarif: {$prestation->tarif}\n";
    echo "Unité: {$prestation->unite}\n";
    echo "\n";
}
*/
//V2 :
$prestations = Prestation::with('categorie')->get();

foreach ($prestations as $prestation) {
    echo "Libellé prestation: {$prestation->libelle}\n";
    echo "Catégorie: {$prestation->categorie->libelle}\n";
    echo "Tarif: {$prestation->tarif}\n";
    echo "Unité: {$prestation->unite}\n";
    echo "\n";
}