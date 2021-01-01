# Paginação com busca

Esta versão foi baseada no aplicativo de exemplo:

https://www.kodingmadesimple.com/2017/01/simple-ajax-pagination-in-jquery-php-pdo-mysql.html

Que usa o plugin para jQuery jquery.bootpage.

Com este plugin suporta um milhão de registros sem perca de performance.


## Dica:

Para importar um script assim com 1 milhão de registros precisamos configurar o myspaginacaoql

sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

Aumentei o valor do parâmetro:
max_allowed_packet para 128

E reiniciei o serviço do mysql.

Importar com:

mysql -uroot -p paginacao < clientes_1milhao.sql


