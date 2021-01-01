<?php
require_once('includes/connection.php');

$id=$_GET['id'];

$sth = $pdo->prepare("SELECT id, name,email from $table WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_INT);
$sth->execute();

$reg = $sth->fetch();
$name = $reg->name;
$email = $reg->email;
require_once('includes/header.php');
?>
<div align="center">
<h2 class="text-center">Exclusão de cliente</h2>
<h3 class="text-center">Tem certeza de que deseja excluir o registro <?=$id?>?</h3>

<br>
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

    <table class="table table-striped table-sm table-bordered table-hover"> 
    <tr><td><b>Nome</td><td><?=$name?></td></tr>
    <tr><td><b>E-mail</td><td><?=$email?></td></tr>
    </table>
    <form method="post" action="">
    <input name="id" type="hidden" value="<?=$id?>">
    <input name="enviar" type="submit" value="Excluir!" class="btn btn-primary">
    </form>
</div>
</div>

<?php
if(isset($_POST['enviar'])){
$id = $_POST['id'];
    $sql = "DELETE FROM  $table WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);   
    if( $sth->execute()){
        print "<script>alert('Registro excluído com sucesso!');location='index.php';</script>";
    }else{
        print "Erro ao exclur o registro!<br><br>";
    }
}
?>
<br>
<hr>
<div class="text-center"><a href="index.php">Voltar</a></div>
