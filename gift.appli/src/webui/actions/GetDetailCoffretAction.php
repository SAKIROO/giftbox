<?php
namespace gift\appli\controlers;

use gift\appli\models\CoffretType;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetDetailCoffretAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;
        $coffret = CoffretType::with('prestations')->find($id);

        if (!$coffret) {
            throw new HttpNotFoundException($rq, 'Coffret non trouvé');
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'detail_coffret.twig', ['coffret' => $coffret]);
    }
}
