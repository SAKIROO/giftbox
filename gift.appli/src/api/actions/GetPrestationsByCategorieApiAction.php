<?php

namespace giftbox\api\actions;

use giftbox\application_core\domain\entities\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class GetPrestationsByCategorieApiAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;

        $categorie = Categorie::with('prestations')->find($id);

        if (!$categorie) {
            throw new HttpNotFoundException($rq, "Catégorie non trouvée");
        }

        $prestations = [];

        foreach ($categorie->prestations as $p) {
            $prestations[] = [
                'id' => $p->id,
                'libelle' => $p->libelle,
                'description' => $p->description,
                'tarif' => $p->tarif
            ];
        }

        $data = [
            'type' => 'collection',
            'category' => [
                'id' => $categorie->id,
                'libelle' => $categorie->libelle,
                'description' => $categorie->description
            ],
            'count' => count($prestations),
            'prestations' => $prestations
        ];

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}
