<?php

namespace giftbox\application_core\domain\exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct(string $message = "Ressource non trouvée", int $code = 404, ?Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}