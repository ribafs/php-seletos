<?php
require_once('classes/crud.php');
$crud = new Crud($pdo);

$id=$_GET['id'];

$sth = $pdo->prepare("SELECT id, name,email,city from customers WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR); // No select e no delete basta um bindValue
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_OBJ);
$name = $reg->name;
$email = $reg->email;
$city = $reg->city;

require_once('header.php');
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$conn->title?> <br>Atualizar</h3></b></div>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="">
                <table class="table table-bordered table-responsive table-hover">
                <tr><td><b>Name</td><td><input type="text" name="name" value="<?=$name?>"></td></tr>
                <tr><td><b>E-mail</td><td><input type="text" name="email" value="<?=$email?>"></td></tr>
                <tr><td><b>City</td><td><input type="text" name="city" value="<?=$city?>"></td></tr>
                <input name="id" type="hidden" value="<?=$id?>">
                <tr><td></td><td><input name="enviar" class="btn btn-primary" type="submit" value="Editar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="enviar" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
                </table>
            </form>
            <?php require_once('footer.php'); ?>
        </div>
    <div>
</div>

<?php

    if($crud->update()){
        print 'Registro alterado com sucesso!';
        header('location: index.php');
        exit();
    }else{
        print "Erro ao alterar o registro!<br><br>";
        exit();
    }

?>

