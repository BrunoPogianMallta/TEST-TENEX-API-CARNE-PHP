<?php

namespace App\Services;

class CarneService
{
    private $storagePath = 'carnes/'; 

    public function gerarCarne($data)
    {
        $carne = new \stdClass(); 
        $carne->id = uniqid(); 
        $carne->valor_total = $data['valor_total'];
        $carne->qtd_parcelas = $data['qtd_parcelas'];
        $carne->data_primeiro_vencimento = $data['data_primeiro_vencimento'];
        $carne->periodicidade = $data['periodicidade'];
        $carne->valor_entrada = $data['valor_entrada'] ?? 0;

        $parcelas = [];

        if ($carne->valor_entrada > 0) {
            $parcelas[] = [
                'data_vencimento' => $carne->data_primeiro_vencimento,
                'valor' => $carne->valor_entrada,
                'numero' => 1,
                'entrada' => true
            ];

            $carne->valor_total -= $carne->valor_entrada;
            $carne->qtd_parcelas--;
        }

        $valorParcela = round($carne->valor_total / $carne->qtd_parcelas, 2);
        $diferenca = round($carne->valor_total - ($valorParcela * $carne->qtd_parcelas), 2);

        $dataVencimento = new \DateTime($carne->data_primeiro_vencimento);

        for ($i = 1; $i <= $carne->qtd_parcelas; $i++) {
            if ($i == 1 && $carne->valor_entrada > 0) {
                $parcelaNumero = $i + 1;
            } else {
                $parcelaNumero = $i;
            }

            if ($i == $carne->qtd_parcelas) {
                $valorParcela += $diferenca;
            }

            $parcelas[] = [
                'data_vencimento' => $dataVencimento->format('Y-m-d'),
                'valor' => $valorParcela,
                'numero' => $parcelaNumero
            ];

            if ($carne->periodicidade === 'mensal') {
                $dataVencimento->modify('+1 month');
            } elseif ($carne->periodicidade === 'semanal') {
                $dataVencimento->modify('+1 week');
            }
        }

        $carneData = [
            'id' => $carne->id,
            'total' => $carne->valor_total + $carne->valor_entrada,
            'valor_entrada' => $carne->valor_entrada,
            'parcelas' => $parcelas
        ];

        $this->salvarCarne($carneData);

        return $carneData;
    }

    private function salvarCarne($carneData)
{
    if (!file_exists($this->storagePath)) {
        mkdir($this->storagePath, 0777, true); 
    }
    $filePath = $this->storagePath . $carneData['id'] . '.json';
    file_put_contents($filePath, json_encode($carneData));
}

    public function recuperarCarnePorId($id)
    {
        $filePath = $this->storagePath . $id . '.json';
        if (file_exists($filePath)) {
            return json_decode(file_get_contents($filePath), true);
        } else {
            return null;
        }
    }
}
