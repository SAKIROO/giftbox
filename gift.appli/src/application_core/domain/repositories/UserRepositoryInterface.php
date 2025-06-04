<?php

namespace giftbox\application_core\domain\repositories;

use giftbox\application_core\domain\entities\User;

interface UserRepositoryInterface {
    public function findByUserId(string $userId): ?User;
    public function save(User $user): void;
}
