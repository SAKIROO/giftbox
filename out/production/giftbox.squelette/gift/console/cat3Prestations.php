<?php

require_once __DIR__ . '/../vendor/autoload.php';

use gift\appli\utils\Eloquent;
use gift\appli\models\Categorie;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini');

try {
    $categorie = Categorie::findOrFail(3);

    echo "ID: {$categorie->id}\n";
    echo "Libellé: {$categorie->libelle}\n";
    echo "Description: {$categorie->description}\n";
    echo "Prestations :\n";

    foreach ($categorie->prestations as $prestation) {
        echo "- Libellé: {$prestation->libelle}, Tarif: {$prestation->tarif}, Unité: {$prestation->unite}\n";

    }

} catch (ModelNotFoundException $e) {
    echo "$e\n";
}