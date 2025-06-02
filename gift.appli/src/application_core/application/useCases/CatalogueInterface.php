<?php

namespace gift\application_core\application\useCases;

interface CatalogueInterface {
    public function getCategories(): array;
    public function getCategorieById(string $id): array;
    public function getPrestationById(string $id): array;
    public function getPrestationsbyCategorie(string $categ_id): array;
    public function getThemesCoffrets(): array;
    public function getCoffretById(string $id): array;
}
