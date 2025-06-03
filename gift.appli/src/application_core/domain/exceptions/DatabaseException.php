<?php

namespace giftbox\application_core\domain\exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function __construct(string $message = "Erreur base de données", int $code = 500, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}