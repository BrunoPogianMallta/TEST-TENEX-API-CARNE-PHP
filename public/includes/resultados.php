<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnê Gerado</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/components/result.css">
</head>
<body>
    <div class="result-container">
        <h1 class="header">Carnê Gerado</h1>
        
        <div class="info-container">
            <p><strong>ID do Carnê:</strong> <?php echo htmlspecialchars($result['id']); ?></p>
            <p><strong>Número de parcelas:</strong> <?php echo count($result['parcelas']); ?></p>
        </div>
        
        <table class="result-table">
            <thead>
                <tr>
                    <th>Nº Parcela</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result['parcelas'] as $parcela): ?>
                    <tr>
                        <td class="numero"><?php echo htmlspecialchars($parcela['numero']); ?></td>
                        <td class="valor">R$ <?php echo number_format($parcela['valor'], 2, ',', '.'); ?></td>
                        <td class="vencimento"><?php echo date('d/m/Y', strtotime($parcela['data_vencimento'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="info-container total">
            <p><strong>Valor Total do Carnê:</strong> R$ <?php echo number_format(array_sum(array_column($result['parcelas'], 'valor')), 2, ',', '.'); ?></p>
        </div>
        
        <a href="visualizarCarne.php" class="btn">Gerar Novo Carnê</a>
    </div>
</body>
</html>
