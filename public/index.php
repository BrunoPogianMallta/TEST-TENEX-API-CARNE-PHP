<?php

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$storagePath = __DIR__ . '/carnes/';

$requestUri = $_SERVER['REQUEST_URI'];


$requestUri = str_replace('/public', '', $requestUri);


if (preg_match('/^\/carne\/([^\/]+)$/', $requestUri, $matches)) {
   
    $id = $matches[1];
    $filePath = $storagePath . $id . '.json';

    if (file_exists($filePath)) {
        header('Content-Type: application/json');
        echo file_get_contents($filePath);
    } else {
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['error' => 'Carnê não encontrado.']);
    }
} elseif ($requestUri === '/carnes') {
 
    $files = glob($storagePath . '*.json');
    $carnes = [];

    foreach ($files as $file) {
        $carnes[] = json_decode(file_get_contents($file), true);
    }

    header('Content-Type: application/json');
    echo json_encode($carnes);
} else {
 
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada.']);
}
