<div class="form-container">
    <h1>Gerar Carnê</h1>
    <form action="" method="post">
        <label for="valor_total">Valor Total:</label>
        <input type="number" step="0.01" id="valor_total" name="valor_total" required>
        
        <label for="qtd_parcelas">Quantidade de Parcelas:</label>
        <input type="number" id="qtd_parcelas" name="qtd_parcelas" required>
        
        <label for="data_primeiro_vencimento">Data do Primeiro Vencimento:</label>
        <input type="date" id="data_primeiro_vencimento" name="data_primeiro_vencimento" required>
        
        <label for="periodicidade">Periodicidade:</label>
        <select id="periodicidade" name="periodicidade" required>
            <option value="mensal">Mensal</option>
            <option value="semanal">Semanal</option>
        </select>
        
        <label for="valor_entrada">Valor da Entrada:</label>
        <input type="number" step="0.01" id="valor_entrada" name="valor_entrada">
        
        <input type="submit" value="Gerar Carnê">
    </form>
</div>
