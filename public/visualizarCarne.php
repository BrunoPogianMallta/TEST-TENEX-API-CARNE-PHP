<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require '../src/services/CarneService.php';

use App\Services\CarneService;


$service = new CarneService();
$showForm = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'valor_total' => $_POST['valor_total'],
        'qtd_parcelas' => $_POST['qtd_parcelas'],
        'data_primeiro_vencimento' => $_POST['data_primeiro_vencimento'],
        'periodicidade' => $_POST['periodicidade'],
        'valor_entrada' => $_POST['valor_entrada'] ?? 0
    ];

    $result = $service->gerarCarne($data);
    $showForm = false;
} else {
    $result = null;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Carnê</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/components/form.css">
    <link rel="stylesheet" href="css/components/result.css">
</head>
<body>
    <div class="container">
        <?php if ($showForm): ?>
            <?php include 'includes/formulario.php'; ?>
        <?php else: ?>
            <?php include 'includes/resultados.php'; ?>
        <?php endif; ?>
    </div>
</body>
</html>
