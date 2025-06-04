<?php

namespace giftbox\application_core\application\useCases;

interface AuthnServiceInterface {
    public function register(string $userId, string $password): void;
    public function checkCredentials(string $userId, string $password): bool;
}
