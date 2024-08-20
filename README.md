# API Geradora de Carnê de Pagamento

## Instalação

1. Clonar o repositório do Git Hub:
    ```bash
    git clone https://github.com/BrunoPogianMallta/TEST-TENEX-API-CARNE-PHP.git
    cd test-tenex-api-carne-php
    ```

2. Instalar as dependências necessárias:
    ```bash
    composer install
    ```



## Execução

1. Execute o servidor:
    ```bash
    php -S localhost:8080 -t public
    ```

2. Testar as rotas com o Postman ou Insomnia.

## Rotas

### `POST /carne`
- **Descrição:** Cria um novo carnê de pagamento.
- **Parâmetros:**
    - `valor_total` (float): Valor total do carnê.
    - `qtd_parcelas` (int): Quantidade de parcelas.
    - `data_primeiro_vencimento` (string): Data do primeiro vencimento (YYYY-MM-DD).
    - `periodicidade` (string): Periodicidade das parcelas (mensal, semanal).
    - `valor_entrada` (float, opcional): Valor da entrada.

### `GET /carne/{id}`
- **Descrição:** Recupera as parcelas de um carnê pelo ID.

## Vizualizar e testa aplicação no navegador
1- executar o servidor em php -S localhost:8080 -t public

2-acessar http://localhost:8080/visualizarCarne.php


## Licença

Este projeto está licenciado sob a licença MIT.
