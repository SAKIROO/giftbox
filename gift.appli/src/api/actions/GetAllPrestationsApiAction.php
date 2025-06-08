<?php

namespace giftbox\api\actions;

use giftbox\application_core\domain\entities\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetAllPrestationsApiAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $prestations = Prestation::all()->map(function ($p) {
            return [
                'id' => $p->id,
                'libelle' => $p->libelle,
                'description' => $p->description,
                'tarif' => $p->tarif,
                'links' => [
                    'self' => [
                        'href' => '/api/prestations/' . $p->id
                    ]
                ]
            ];
        });

        $payload = [
            'type' => 'collection',
            'count' => $prestations->count(),
            'prestations' => $prestations
        ];

        $response->getBody()->write(json_encode($payload, JSON_PRETTY_PRINT));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
