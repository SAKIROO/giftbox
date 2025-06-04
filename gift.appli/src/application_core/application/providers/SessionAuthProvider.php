<?php

namespace giftbox\application_core\application\providers;

use giftbox\application_core\application\useCases\AuthnServiceInterface;
use giftbox\application_core\domain\entities\User;
use giftbox\application_core\domain\repositories\UserRepositoryInterface;

class SessionAuthProvider implements AuthProviderInterface
{
    private AuthnServiceInterface $authnService;
    private UserRepositoryInterface $userRepo;

    public function __construct(AuthnServiceInterface $authnService, UserRepositoryInterface $userRepo)
    {
        $this->authnService = $authnService;
        $this->userRepo = $userRepo;
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function signin(string $email, string $password): bool
    {
        if ($this->authnService->checkCredentials($email, $password)) {
            $_SESSION['auth_email'] = $email;
            return true;
        }
        return false;
    }

    public function getSignedInUser(): ?User
    {
        if (!isset($_SESSION['auth_email'])) {
            return null;
        }

        return $this->userRepo->findByEmail($_SESSION['auth_email']);
    }
}
