<?php 
require_once('includes/connection.php');

// Busca
if(isset($_GET['keyword'])){
    $keyword=$_GET['keyword'];

    $sql = "select * from $table WHERE nome LIKE :keyword order by id";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(":keyword", $keyword."%");
    $sth->execute();
	//$nr = $sth->rowCount();
    $rows =$sth->fetchAll();
}
require_once('includes/header.php');
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$title?></b></h3></div>
<?php
print '<div class="text-center"><h4><b>Registro(s) encontrado(s)</b>: '.count($rows).' com '.$keyword.'</h4></div>';

if(count($rows) > 0){
?>

    <table class="table table-hover">
        <thead>  
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nascimento</th>
                <th>CPF</th>
            </tr>
        </thead>

<?php
    // Loop através dos registros recebidos
    foreach ($rows as $row){
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>'; 
        echo '<td>' . $row['nome'] . '</td>'; 
        echo '<td>' . $row['email'] . '</td>'; 
        echo '<td>' . $row['nascimento'] . '</td>';  
        echo '<td>' . $row['cpf'] . '</td>';
        echo '</tr>';
    } 
    echo "</table>";

}else{
    print '<h3>Nenhum Registro encontrado!</h3>
</div>';
}
?>

<div class="text-center"><input name="send" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></div>
</div>
<br>
<?php require_once('includes/footer.php'); ?>
