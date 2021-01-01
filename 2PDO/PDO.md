# PDO - PHP Data Objects

https://www.php.net/manual/en/book.pdo.php

Como a maioria das aplicações usa bancos de dados, então conheçamos melhor o PDO.

É uma extensão do PHP para conexão com diversos SGBDs:

https://www.php.net/manual/en/pdo.drivers.php

A grande maioria dos SGBDs tem suporte ao PHP através do PDO e seu driver deve ser instalado para o devido suporte. Geraalmente já vem no php.ini  comentado. Apenas descomente e reinicie o servidor web.

Para saber que drivers do PDO já estão habilitados em seu sistema execute:

print_r(PDO::getAvailableDrivers());

Via terminal

php -i | grep 'pdo'

ou

phpinfo();

Instalação

Todos os pacotes for windows já vem com o PDO
No máximo precisará descomentar no php.ini e reiniciar o Apache

No Linux

sudo apt install php7.4-pdo

sudo apt install php7.4-pdo-mysql

sudo apt install php7.4-pdo-pgsql

sudo apt install php7.4-pdo-sqlite

sudo apt install php7.4-pdo-odbc

PDO forma uma camada que separa o banco de dados do seu código PHP.

Apareceu na versão 5.1 do PHP com uma extensão PECL. Como requer recursos de OO não deve rodar em versões anteriores do PHP.

Constantes predefinidas:

https://www.php.net/manual/en/pdo.constants.php

Conexão

https://www.php.net/manual/en/pdo.connections.php

Transações

https://www.php.net/manual/en/pdo.transactions.php

Prepared statements/Declarações preparadas

https://www.php.net/manual/en/pdo.prepared-statements.php

Exemplo:
```php
$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':value', $value);
```
Este exemplo executa uma consulta insert substituindo name e value pelos nomeados placeholders :name e :value

Vantagens: quando usamos prepared statments o PDO se encarrega de escaping e quoting os valores recebidos do usuário, tornando assim nosso código mais seguro.

Manipulação de erros

https://www.php.net/manual/en/pdo.error-handling.php

Singleton - padrão de projeto para garantir que somente uma conexão por banco de dados seja efetuada

Conexão simples

$connection = new PDO('mysql:host=localhost;dbname=teste;charset=utf8', 'root', 'root');

Insert

$connection->exec('INSERT INTO users VALUES (1, "somevalue"');

$affectedRows = $connection->exec('INSERT INTO users VALUES (1, "somevalue"');

echo $affectedRows;

Select
```php
$result = mysql_query('SELECT * FROM users');

while($row = mysql_fetch_assoc($result)) {
    echo $row['id'] . ' ' . $row['name'];
}

foreach($connection->query('SELECT * FROM users') as $row) {
    echo $row['id'] . ' ' . $row['name'];
}
```
Minha constante preferida

PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set. For example, $row->id would hold the value of the id column. 
```php
$statement = $connection->query('SELECT * FROM users');

while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo $row['id'] . ' ' . $row['name'];
}

$statement = $connection->query('SELECT * FROM users');

while($row = $statement->fetch(PDO::FETCH_OBJ)) {
    echo $row->id . ' ' . $row->name;
}
```
The PDO exec() executes an SQL statement and returns the number of affected rows. 
affected_rows.php
```php
$dsn = "mysql:host=localhost;dbname=mydb";
$user = "user12";
$passwd = "12user";

$pdo = new PDO($dsn, $user, $passwd);

$id = 12;

$nrows = $pdo->exec("DELETE FROM countries WHERE id IN (1, 2, 3)");

echo "The statement affected $nrows rows\n";
```
transaction.php
```php
$dsn = "mysql:host=localhost;dbname=mydb";
$user = "user12";
$passwd = "12user";

$pdo = new PDO($dsn, $user, $passwd);

try {

    $pdo->beginTransaction();
    $stm = $pdo->exec("INSERT INTO countries(name, population) VALUES ('Iraq', 38274000)");
    $stm = $pdo->exec("INSERT INTO countries(name, population) VALUES ('Uganda', 37673800)");

    $pdo->commit();

} catch(Exception $e) {

    $pdo->rollback();
    throw $e;
}
```
https://phpdelusions.net/pdo

http://zetcode.com/php/pdo/

https://culttt.com/2012/10/01/roll-your-own-pdo-php-class/ 

https://www.sitepoint.com/re-introducing-pdo-the-right-way-to-access-databases-in-php/

