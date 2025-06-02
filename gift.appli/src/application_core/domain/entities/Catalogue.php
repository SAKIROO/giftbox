<?php
namespace giftbox\application_core\domain\entities;

use gift\application_core\application\useCases\CatalogueInterface;

class Catalogue implements CatalogueInterface {

    public function getCategories(): array {
        return Categorie::all()->toArray();
    }

    public function getCategorieById(string $id): array {
        return Categorie::with('prestations')->findOrFail($id)->toArray();
    }

    public function getPrestationById(string $id): array {
        return Prestation::findOrFail($id)->toArray();
    }

    public function getPrestationsbyCategorie(string $categ_id): array {
        $cat = Categorie::with('prestations')->findOrFail($categ_id);
        return $cat->prestations->toArray();
    }

    public function getThemesCoffrets(): array {
        return Theme::with('coffrets')->get()->toArray();
    }

    public function getCoffretById(string $id): array {
        return CoffretType::with('prestations')->findOrFail($id)->toArray();
    }
}
