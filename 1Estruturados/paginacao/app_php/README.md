# Projeto de Aplicativo para gerenciar duas tabelas com PHP

## Este aplicativo usará os recursos:

- PDO
- Paginação com o plugin do jQuery bootpag
- Busca
- BootStrap
- Suporte testado ao MySQL e ao PostgreSQL

Mas será construído inteiramente com PHP estruturado

Este projeto usará duas tabelas: clientes e produtos e terá um menu inicial com links para as duas tabelas.

## Parâmetros do PDO

Inteiros - PDO::PARAM_INT

Strings - PDO::PARAM_STR

Strings de tamanho 12 -PDO::PARAM_STR, 12

Boolean - PDO::PARAM_BOOL

Nulos - PDO::PARAM_NULL

## Organização

Uma das vantagens da orientação a objetos é a organização do código, a separação em camadas (MVC). Aqui é um código que não usa OO, mas gosto de ter o código da forma mais orgnaizada possível. Todos os assets dentro de uma pasta e os includes dentro de outra e também crio os arquivos header.php e footer.php para incluir nos arquivos onde são necessários.

## Relação de glyphicons:

https://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp

## A paginação básica que utilizei para criar este aplicativo:

https://www.kodingmadesimple.com/2017/01/simple-ajax-pagination-in-jquery-php-pdo-mysql.html
