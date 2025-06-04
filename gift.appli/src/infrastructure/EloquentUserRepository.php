<?php

namespace giftbox\infrastructure;

use giftbox\application_core\domain\entities\User;
use giftbox\application_core\domain\repositories\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findByUserId(string $userId): ?User
    {
        return User::where('user_id', $userId)->first();
    }

    public function save(User $user): void
    {
        $user->save();
    }
}
