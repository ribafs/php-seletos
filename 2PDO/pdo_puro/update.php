<?php
require_once('conexao.php');

$id=$_GET['id'];

$sth = $pdo->prepare("SELECT id, nome,email,data_nasc,cpf from clientes WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR); // No select e no delete basta um bindValue
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_OBJ);
$nome = $reg->nome;
$email = $reg->email;
$data_nasc = $reg->data_nasc;
$cpf = $reg->cpf;
?>

<h2 align="center">Editar cliente</h2>
<div align="center">
<form method="post" action="">
Nome<input type="text" name="nome" value="<?=$nome?>"><br>
E-mail<input type="text" name="email" value="<?=$email?>"><br>
Nascimento<input type="text" name="data_nasc" value="<?=$data_nasc?>"><br>
CPF<input type="text" name="cpf" value="<?=$cpf?>"><br>
<input name="id" type="hidden" value="<?=$id?>">
<input name="enviar" type="submit" value="Editar">
</form>
</div>

<?php

if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nasc = $_POST['data_nasc'];
    $cpf = $_POST['cpf'];

    $sql = "UPDATE $tabela SET nome = :nome, email=:email, data_nasc=:data_nasc, cpf=:cpf WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
    $sth->bindParam(':nome', $_POST['nome'], PDO::PARAM_INT);   
    $sth->bindParam(':email', $_POST['email'], PDO::PARAM_INT);   
    $sth->bindParam(':data_nasc', $_POST['data_nasc'], PDO::PARAM_INT);   
    $sth->bindParam(':cpf', $_POST['cpf'], PDO::PARAM_INT);   

   if($sth->execute()){
        print "<script>alert('Registro alterado com sucesso!');location='index.php';</script>";
    }else{
        print "Erro ao editar o registro!<br><br>";
    }
}
?>
<div align="center"><a href="index.php">Voltar</a></div>
