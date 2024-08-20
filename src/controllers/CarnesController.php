<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\CarneService;

class CarnesController
{
    private $carneService;

    public function __construct()
    {
        $this->carneService = new CarneService();
    }

    public function criarCarne(Request $request, Response $response, $args): Response
    {
        $data = $request->getParsedBody();

        if (!isset($data['valor_total']) || !isset($data['qtd_parcelas']) || !isset($data['data_primeiro_vencimento']) || !isset($data['periodicidade'])) {
            $response->getBody()->write(json_encode(['error' => 'Parâmetros obrigatórios ausentes.']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $resultado = $this->carneService->gerarCarne($data);
            $response->getBody()->write(json_encode($resultado));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
    }

    public function recuperarParcelas(Request $request, Response $response, $args): Response
    {
        $id = $args['id'];

        $carne = $this->carneService->recuperarCarnePorId($id);

        if ($carne) {
            $response->getBody()->write(json_encode($carne));
            return $response->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode(['error' => 'Carnê não encontrado.']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
    }

    
}
