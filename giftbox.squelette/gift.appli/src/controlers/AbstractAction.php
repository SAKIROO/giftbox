<?php

namespace gift\appli\controlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class AbstractAction {
    abstract public function __invoke(Request $rq, Response $rs, array $args): Response;
}
