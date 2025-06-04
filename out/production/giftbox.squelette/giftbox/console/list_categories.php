<?php

require_once __DIR__ . '/../vendor/autoload.php';

use gift\appli\utils\Eloquent;
use gift\appli\models\Categorie;

Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini');

$categories = Categorie::all();

foreach ($categories as $categorie) {
    echo "ID: {$categorie->id}\n";
    echo "Libellé: {$categorie->libelle}\n";
    echo "Description: {$categorie->description}\n";
    echo "-------------------------\n";
}