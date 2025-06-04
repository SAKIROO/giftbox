<?php

namespace giftbox\application_core\application\providers;

use giftbox\application_core\application\providers\AuthProviderInterface;
use giftbox\application_core\application\useCases\AuthnServiceInterface;
use giftbox\application_core\domain\repositories\UserRepositoryInterface;
use giftbox\application_core\domain\entities\User;

class SessionAuthProvider implements AuthProviderInterface
{
    private AuthnServiceInterface $authnService;
    private UserRepositoryInterface $repo;

    public function __construct(
        AuthnServiceInterface $authnService,
        UserRepositoryInterface $repo
    ) {
        $this->repo = $repo;
        $this->authnService = $authnService;
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public function signin(string $userId, string $password): bool
    {
        if ($this->authnService->checkCredentials($userId, $password)) {
            $_SESSION['user_id'] = $userId;
            return true;
        }
        return false;
    }

    public function getSignedInUser(): ?User
    {
        return isset($_SESSION['user_id']) ? $this->repo->findByUserId($_SESSION['user_id']) : null;
    }
}
