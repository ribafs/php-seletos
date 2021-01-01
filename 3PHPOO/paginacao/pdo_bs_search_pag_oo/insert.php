<?php
require_once('header.php');
require_once('classes/crud.php');
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$conn->title?> <br> (Adicionar)</b></h3></div>
        <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6">

        <table class="table table-bordered table-responsive table-hover">    
            <form method="post" action="insert.php">           
            <tr><td>Name</td><td><input type="text" name="name" autofocus></td></tr>
            <tr><td>E-mail</td><td><input type="text" name="email"></td></tr>
            <tr><td>City</td><td><input type="text" name="city"></td></tr>
            <tr><td></td><td><input class="btn btn-primary" name="enviar" type="submit" value="Cadastrar">&nbsp;&nbsp;&nbsp;
            <input class="btn btn-warning" name="enviar" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
            </form>
        </table>
        </div>
    </div>
</div>

<?php
$crud = new Crud($pdo);

if($crud->insert()){
    echo 'Registro adicionado com sucesso';
    header('location: index.php');
    exit();
}

require_once('footer.php');
?>

