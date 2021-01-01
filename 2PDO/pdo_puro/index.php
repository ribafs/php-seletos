<html>
<h1 align="center">CRUD Muito Simples usando PDO</h1>

<div align="center">
<a href="add.php">Novo Cliente</a>
</div>
<br>

<?php
require_once('conexao.php');

try{
    $stmte = $pdo->query("SELECT * FROM $tabela order by nome");
    $executa = $stmte->execute();
?>

    <table border="2" align="center">
    <tr><td><b>ID</td><td><b>Nome</td><td><b>Email</td><td><b>Nascimento</td><td><b>CPF</td><td colspan="2" align="center">Ação</td></tr>

<?php
    if($executa){
        while($reg = $stmte->fetch(PDO::FETCH_OBJ)){ // Para recuperar um ARRAY utilize PDO::FETCH_ASSOC 
?>
            <tr><td><?=$reg->id?></td>
            <td><?=$reg->nome?></td>
            <td><?=$reg->email?></td>
            <td><?=$reg->data_nasc?></td>
            <td><?=$reg->cpf?></td>
            <td><a href="update.php?id=<?=$reg->id?>">Editar</a></td>
            <td><a href="delete.php?id=<?=$reg->id?>">Excluir</a></td></tr>
<?php
       }
       print '</table>';
    }else{
           echo 'Erro ao inserir os dados';
    }
}catch(PDOException $e){
      echo $e->getMessage();
}
