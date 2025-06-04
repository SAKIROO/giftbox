<?php

namespace giftbox\application_core\application\providers;

use giftbox\application_core\domain\entities\User;

interface AuthProviderInterface {
    public function getSignedInUser(): ?User;
    public function signin(string $userId, string $password): bool;
}
