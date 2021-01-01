<?php
require_once('classes/crud.php');
$crud = new Crud($pdo);

$id=$_GET['id'];

$sth = $crud->pdo->prepare("SELECT id, name,email,city from customers WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR);
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_OBJ);
$name = $reg->name;
$email = $reg->email;
$city = $reg->city;

require_once('header.php');
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$conn->title?> <br> Excluir</h3></b></div>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Realmente excluir o registro abaixo?</h3>
            <br>
            <b>ID:</b> <?=$id?><br>
            <b>Name:</b> <?=$name?><br>
            <b>E-mail:</b> <?=$email?><br>
            <b>City:</b> <?=$city?><br>
            <br>
            <form method="post" action="">
            <input name="id" type="hidden" value="<?=$id?>">
            <input name="enviar" class="btn btn-danger" type="submit" value="Excluir!">&nbsp;&nbsp;&nbsp;
            <input name="enviar" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar">
            </form>
            <br><br><br>
        <?php require_once('footer.php'); ?>
        </div>
    <div>
</div>

<?php
if($crud->delete($id)){
    echo 'Registro excluído com sucesso';
    header('location: index.php');
}

?>
