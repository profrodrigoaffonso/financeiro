# Aplicativo de finanças pessoais

Um aplicativo web para fiananças pessoais .

## Funcionalidades

- Cadastrar contas de bancos
- Cadastrar formas de pagamentos
- Cadastrar despesas pessoais
- Emitir relatórios de pagamentos podendo exportar em Excel


## Tecnologias utilizadas

- PHP 8.1
- Laravel 10
- MySQL
- HTML / CSS
- JavaScript
- Bootsrapp
- PHPOffice/PhpSpreadsheet

## Estrutura do projeto

```text

app/
├── Http/
│ └── Controllers/
│   ├──  BancosController.php
|   ├── CategoriasController.php
|   ├── FormaPagamentosController.php
|   ├── LoginController.php
|   └── PagamentosController.php| 
├── Models/
│ ├── Bancos.php
│ ├── Categorias.php
│ ├── FormaPagamentos.php
│ ├── Pagamentos.php
│ ├── Saques.php
│ └── User.php
routes/
├──  api.php
└── web.php