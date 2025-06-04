<?php

namespace giftbox\application_core\domain\repositories;

use giftbox\application_core\domain\entities\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function save(User $user): void;
}
