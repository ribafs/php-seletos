### Introdução ao PDO

A extensão PHP Data Objects (PDO) define uma interface leve e consistente para acessar bancos de dados em PHP. Cada driver de banco de dados que implementa a interface PDO pode expor recursos específicos do banco de dados como funções de extensão regulares. Observe que você não pode executar nenhuma função de banco de dados usando a extensão PDO sozinha; você deve usar um driver PDO específico do banco de dados para acessar um servidor de banco de dados.

O PDO fornece uma camada de abstração de acesso a dados, o que significa que, independentemente de qual banco de dados você está usando, você usa as mesmas funções para emitir consultas e buscar dados. PDO não fornece uma abstração de banco de dados; ele não reescreve o SQL ou emula recursos ausentes. Você deve usar uma camada de abstração completa se precisar desse recurso.

PDO vem com o PHP 5.1 e está disponível como uma extensão PECL para PHP 5.0; O PDO requer os novos recursos OO no núcleo do PHP 5 e, portanto, não será executado com versões anteriores do PHP.

Suporta diversos SGBDs e é o padrão dos grandes frameworks PHP, inclusive o Laravel.

### Pequeno CRUD com PHP e PDO acessando um banco do SGBD MySQL.

Após finalizar o aplicativo, se quizer mudar de SGBD para o PostgreSQL, por exemplo, basta mudar os dados da conexão.

### Script do banco

db.sql

```php
CREATE TABLE clients (
    id int primary key auto_increment,
    name varchar(50) not null,
    email varchar(50) unique not null
);

INSERT INTO clients (name, email) VALUES 
('Sr. Adriano Vicente Furtado Jr.','valentina85@avila.com'),
('Dr. Valentin Franco Guerra Neto','tomas07@correia.net.br'),
('Dr. Jácomo Salazar','garcia.tabata@lovato.br'),
('Hernani Valência Santacruz Jr.','fabio17@r7.com'),
('Dr. Thiago Mário Gomes Sobrinho','padrao.nadia@matias.com'),
('Andrea Ferreira Gonçalves Sobrinho','ffonseca@r7.com'),
('Violeta Ornela Grego','carolina72@r7.com'),
('Srta. Violeta Faro Sobrinho','hernani.campos@hotmail.com');
```

### connection.php

```php
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=pdo;port=3306', 'root', '');
//    print 'Conectou';
} catch (PDOException $e) {
    print "Erro: " . $e->getMessage() . "<br/>";
    die();
}
```

### index.php

```php
<h2 align="center">Cadastro de Clientes</h2>

<h3 align="center"><a href="insert.php">Novo Cliente</a></h3>
 <hr style="width:60%"> 
<table align="center">
<tr><td><b>Nome</b></td><td><b>E-mail</b></td><td><b>Ação</b></td></tr>

<?php
require_once 'connection.php';

$stmt = $pdo->query("SELECT * FROM clients order by id desc");

while ($row = $stmt->fetch()) {

    $id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    ?>

    <tr><td><?=$name?></td><td><?=$email?></td><td><a href="update.php?id=<?=$id?>">Atualizar</a></td>
    <td><a href="delete.php?id=<?=$id?>" onclick="return confirm('Tem certeza de que deseja excluir este cliente ?')">Excluir</a></tr>

<?php
}
?>

</table>
```

### inser.php

```php
<h2 align="center">Cadastro de Clientes</h2>

 <hr style="width:21%"> 

<form method="POST" action="" autocomplete="on">
<table align="center">
<tr><td>Nome</td><td><input type="text" name="name" autocomplete="off"></td></tr>
<tr><td>E-mail</td><td><input type="text" name="email"></td></tr>
<tr><td></td><td><input type="submit" value="Inserir"></td></tr>
</table>

<?php
require_once 'connection.php';

if(isset($_POST['name'])){
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO clients (name, email) VALUES (?,?)";
$pdo->prepare($sql)->execute([$name, $email]);

print "
<script>
location = \"index.php\";
</script>
";
}

?>
```

### update.php

```php
<?php
require_once 'connection.php';

$id = $_GET['id'];
//print $id;exit;
$stmt = $pdo->prepare("SELECT id,name,email FROM clients WHERE id=?");
$stmt->execute([$id]); 
$client = $stmt->fetch(PDO::FETCH_OBJ);
//print_r($client);exit;
$id = $client->id;
$name = $client->name;
$email = $client->email;
?>

<h2 align="center">Atualização de Cliente</h2>
 <hr style="width:23%"> 
<form method="POST" action="" autocomplete="on">
<table align="center">
<tr><td>Nome</td><td><input type="text" name="name" autocomplete="off" value="<?=$name?>"></td></tr>
<tr><td>E-mail</td><td><input type="text" name="email" value="<?=$email?>"></td></tr>
<input type="hidden" name="id" value="<?=$id?>">
<tr><td></td><td><input type="submit" value="Atualizar"></td></tr>
</table>

<?php

if(isset($_POST['name'])){
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "UPDATE clients SET name=?, email=? WHERE id=?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$name, $email, $id]);

print "
<script>
location = \"index.php\";
</script>
";
}

?>
```

### delete.php

```php
<?php
require_once 'connection.php';

if(!empty($_GET['id'])){
      $id = $_GET['id'];

      $stmt = $pdo->prepare( "DELETE FROM clients WHERE id =:id" );
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      if( ! $stmt->rowCount() ) {
        echo "A exclusão falhou";
      }else{
        header("Location:index.php");
      }
}
```

Observe o uso da boa prática de não usar a tag de fechaento do php em arquivos com apenas PHP.

### Referências

https://www.php.net/manual/en/book.pdo.php

https://phpdelusions.net/
