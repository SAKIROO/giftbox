<?php

namespace giftbox\application_core\application\useCases;

interface BoxServiceInterface {
    public function createBox(array $data): array;
    public function addPrestationToBox(string $boxId, string $prestationId, int $quantity): array;
    public function getBoxById(string $boxId): array;
    public function validateBox(string $boxId): array;
}