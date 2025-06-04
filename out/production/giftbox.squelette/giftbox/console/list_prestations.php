<?php

require_once __DIR__ . '/../vendor/autoload.php';

use gift\appli\utils\Eloquent;
use gift\appli\models\Prestation;

Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini');

$prestations = Prestation::all();

foreach ($prestations as $prestation) {
    echo "Libellé: {$prestation->libelle}\n";
    echo "Description: {$prestation->description}\n";
    echo "Tarif: {$prestation->tarif}\n";
    echo "Unité: {$prestation->unite}\n";
    echo "\n";
}