<?php

namespace giftbox\application_core\application\useCases;

interface AuthnServiceInterface
{
    public function register(string $email, string $password): void;
    public function checkCredentials(string $email, string $password): bool;
}
