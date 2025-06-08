<?php
namespace giftbox\api\actions;

use giftbox\application_core\domain\entities\Box;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class GetBoxByIdApiAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;

        $box = Box::with('prestations')->find($id);

        if (!$box) {
            throw new HttpNotFoundException($rq, "Coffret non trouvé");
        }

        $prestations = [];

        foreach ($box->prestations as $presta) {
            $prestations[] = [
                'libelle' => $presta->libelle,
                'description' => $presta->description,
                'contenu' => [
                    'box_id' => $presta->pivot->box_id,
                    'presta_id' => $presta->pivot->presta_id,
                    'quantite' => $presta->pivot->quantite
                ]
            ];
        }

        $data = [
            'type' => 'resource',
            'box' => [
                'id' => $box->id,
                'libelle' => $box->libelle,
                'description' => $box->description,
                'message_kdo' => $box->message_kdo,
                'statut' => $box->statut,
                'prestations' => $prestations
            ]
        ];

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}

