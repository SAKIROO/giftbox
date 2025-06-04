<?php

namespace giftbox\application_core\application\useCases;

use giftbox\application_core\application\useCases\AuthnServiceInterface;
use giftbox\application_core\domain\entities\User;
use giftbox\application_core\domain\repositories\UserRepositoryInterface;

class AuthnService implements AuthnServiceInterface
{
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function register(string $userId, string $password): void
    {
        $user = new User([
            'user_id' => $userId,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 1
        ]);
        $this->repo->save($user);
    }

    public function checkCredentials(string $userId, string $password): bool
    {
        $user = $this->repo->findByUserId($userId);
        return $user && password_verify($password, $user->password);
    }
}
