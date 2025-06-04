<?php
require_once __DIR__ . '/../vendor/autoload.php';

use gift\appli\utils\Eloquent;
use gift\appli\models\CoffretType;
use gift\appli\models\Prestation;

Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini');


//Exercice 5) a

try {
    $coffrets = CoffretType::with('prestations')->get();
    echo "Liste des coffrets types :</br>";
    foreach ($coffrets as $coffret) {
        echo "ID: {$coffret->id}</br>";
        echo "Libellé: {$coffret->libelle}</br>";
        echo "Description: {$coffret->description}</br>";
        echo "</br>";
    }
    echo "Total: " . count($coffrets) . " coffrets types trouvés</br></br>";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "</br>";
}


//Exercice 5)b


$coffret = CoffretType::with('prestations')->first();

if ($coffret) {
    echo "Coffret : {$coffret->libelle}</br>";
    foreach ($coffret->prestations as $prestation) {
        echo "- {$prestation->libelle}</br>";
    }
} else {
    echo "Aucun coffret trouvé</br>";
}

$prestation = Prestation::with('coffrets')->first();

if ($prestation) {
    echo "Prestation : {$prestation->libelle}</br>";
    foreach ($prestation->coffrets as $coffret) {
        echo "- {$coffret->libelle}</br></br></br>";
    }
} else {
    echo "Aucune prestation trouvée</br>";
}

//Exercice 5)c
echo "</br>";
try {
    $coffrets = CoffretType::with('prestations')->get();

    echo "Liste complète des coffrets types :</br>";

    foreach ($coffrets as $coffret) {
        echo "</br>Coffret #{$coffret->id}</br>";
        echo "Libellé: {$coffret->libelle}</br>";
        echo "Description: {$coffret->description}</br>";

        if ($coffret->prestations->isNotEmpty()) {
            echo "</br>Prestations incluses:</br>";
            foreach ($coffret->prestations as $prestation) {
                echo "{$prestation->libelle} | {$prestation->tarif}€ | {$prestation->unite}</br>";
            }
        } else {
            echo "</br>Aucune prestation associée à ce coffret</br>";
        }
    }
} catch (Exception $e) {
    echo "Erreur: " .$e->getMessage()."</br>";
}