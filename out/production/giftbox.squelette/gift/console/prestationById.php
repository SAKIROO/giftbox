<?php

require_once __DIR__ . '/../vendor/autoload.php';

use gift\appli\utils\Eloquent;
use gift\appli\models\Prestation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini');


$id = $argv[1];

try {
    $prestation = Prestation::findOrFail($id);

    echo "Libellé: {$prestation->libelle}\n";
    echo "Description: {$prestation->description}\n";
    echo "Tarif: {$prestation->tarif}\n";
    echo "Unité: {$prestation->unite}\n";
    echo "\n";

} catch (ModelNotFoundException $e) {
    echo "Erreur: Aucune prestation trouvée avec l'identifiant '{$id}'.\n";
    exit(1);
}