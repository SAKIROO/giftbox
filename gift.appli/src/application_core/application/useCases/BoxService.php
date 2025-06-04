<?php

namespace giftbox\application_core\application\useCases;

use giftbox\application_core\domain\entities\Box;
use giftbox\application_core\domain\entities\Prestation;
use giftbox\application_core\domain\exceptions\NotFoundException;
use giftbox\application_core\domain\exceptions\DatabaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class BoxService implements BoxServiceInterface {

    public function createBox(array $data): array {
        try {
            $box = new Box();
            $box->libelle = $data['libelle'];
            $box->description = $data['description'];
            $box->kdo = $data['kdo'] ?? false;
            $box->message_kdo = $data['message_kdo'] ?? null;
            $box->statut = 1; // En construction
            $box->createur_id = $data['createur_id'];
            $box->save();
            return $box->toArray();
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function addPrestationToBox(string $boxId, string $prestationId, int $quantity): array {
        try {
            $box = Box::findOrFail($boxId);
            if ($box->statut != 1) {
                throw new \Exception("Impossible d'ajouter une prestation à une box non modifiable.");
            }
            $box->prestations()->attach($prestationId, ['quantite' => $quantity]);
            return $box->load('prestations')->toArray();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Box non trouvée avec l'id: $boxId");
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function getBoxById(string $boxId): array {
        try {
            return Box::with(['prestations'])->findOrFail($boxId)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Box non trouvée avec l'id: $boxId");
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function validateBox(string $boxId): array {
        try {
            $box = Box::findOrFail($boxId);
            if ($box->prestations()->count() < 2) {
                throw new \Exception("La box doit contenir au moins 2 prestations pour être validée.");
            }
            $box->statut = 2; // Validée
            $box->save();
            return $box->toArray();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Box non trouvée avec l'id: $boxId");
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }
}
