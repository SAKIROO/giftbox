<?php

namespace giftbox\application_core\domain\entities;



use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use giftbox\application_core\domain\exceptions\NotFoundException;
use giftbox\application_core\application\useCases\CatalogueInterface;
use giftbox\application_core\domain\exceptions\DatabaseException;



class Catalogue implements CatalogueInterface {

    public function getCategories(): array {
        try {
            return Categorie::all()->toArray();
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function getCategorieById(int $id): array {
        try {
            return Categorie::with('prestations')->findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Catégorie non trouvée avec l'id: $id");
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function getPrestationById(string $id): array {
        try {
            return Prestation::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Prestation non trouvée avec l'id: $id");
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function getPrestationsbyCategorie(int $categ_id): array {
        try {
            return Prestation::where('categorie_id', $categ_id)->get()->toArray();
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function getThemesCoffrets(): array {
        try {
            return CoffretType::select('theme_id')->distinct()->pluck('theme_id')->toArray();
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }

    public function getCoffretById(int $id): array {
        try {
            return CoffretType::with('prestations')->findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Coffret non trouvé avec l'id: $id");
        } catch (QueryException $e) {
            throw new DatabaseException("Erreur base de données : " . $e->getMessage());
        }
    }
}
