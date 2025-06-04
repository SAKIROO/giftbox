<?php

namespace giftbox\application_core\application\providers;

use giftbox\application_core\domain\exceptions\CsrfException;

class CsrfTokenProvider
{
    public static function generate(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check(?string $token): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
            throw new CsrfException("Invalide CSRF token.");
        }

        unset($_SESSION['csrf_token']);
    }
}
