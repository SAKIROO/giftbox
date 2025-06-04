<?php

namespace giftbox\application_core\application\useCases;

use giftbox\application_core\application\useCases\AuthnServiceInterface;
use giftbox\application_core\domain\entities\User;
use giftbox\application_core\domain\exceptions\UserAlreadyExistsException;
use giftbox\application_core\domain\repositories\UserRepositoryInterface;

class AuthnService implements AuthnServiceInterface
{
    private UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(string $email, string $password): void
    {
        if ($this->userRepo->findByEmail($email)) {
            throw new UserAlreadyExistsException("Utilisateur déjà existant.");
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(null, $email, $hash, 1);
        $this->userRepo->save($user);
    }

    public function checkCredentials(string $email, string $password): bool
    {
        $user = $this->userRepo->findByEmail($email);
        if (!$user) {
            return false;
        }

        return password_verify($password, $user->getPassword());
    }
}
