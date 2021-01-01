<?php
require_once('includes/connection.php');

$id=$_GET['id'];

$sth = $pdo->prepare("SELECT id, name,email from $table WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_INT); // No select e no delete basta um bindValue
$sth->execute();

$reg = $sth->fetch();
$name = $reg->name;
$email = $reg->email;
require_once('includes/header.php');
?>

<h2 class="text-center">Editar cliente</h2>
<div align="center">
<form method="post" action="">
<div class="col-md-3"></div>
<div class="col-md-6">
<table class="table table-striped table-sm table-bordered table-hover">
<tr><td><input type="text" name="name" class="form-control" value="<?=$name?>" placeholder="Nome"></td></tr>
<tr><td><input type="text" name="email" class="form-control" value="<?=$email?>" placeholder="E-mail"></td></tr>
<input name="id" type="hidden" value="<?=$id?>">
<tr><td class="text-center"><input name="enviar" type="submit" value="Editar" class="btn btn-primary"></td></tr>
</table>
</div>
</form>
</div>

<?php
if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE $table SET name = :name, email=:email WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
    $sth->bindParam(':name', $_POST['name'], PDO::PARAM_STR);   
    $sth->bindParam(':email', $_POST['email'], PDO::PARAM_STR);   

   if($sth->execute()){
        print "<script>alert('Registro alterado com sucesso!');location='index.php';</script>";
    }else{
        print "Erro ao editar o registro!<br><br>";
    }
}
?>
<div class="text-center"><a href="index.php">Voltar</a></div>
