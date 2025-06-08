<?php

namespace giftbox\api\actions;

use giftbox\application_core\domain\entities\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategoriesApiAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $categories = Categorie::all();

        $data = [
            'type' => 'collection',
            'count' => $categories->count(),
            'categories' => [],
        ];

        foreach ($categories as $c) {
            $data['categories'][] = [
                'categorie' => [
                    'id' => $c->id,
                    'libelle' => $c->libelle,
                    'description' => $c->description,
                ],
                'links' => [
                    'self' => [
                        'href' => "/categories/{$c->id}/"
                    ]
                ]
            ];
        }

        $rs->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
        return $rs
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
