<?php
require_once('includes/connection.php');
?>

<div align="center">

<form method="post" action="add.php">
<table class="table table-striped table-sm table-bordered table-hover">
<tr><td>Nome</td><td><input type="text" name="nome"></td></tr>
<tr><td>E-mail</td><td><input type="text" name="email"></td></tr>
<tr><td></td><td><input name="enviar" type="submit" value="Cadastrar"></td>/<tr>
</table>
</form>
</div>

<?php

require_once('includes/connection.php');

if(isset($_POST['enviar'])){
$nome = $_POST['name'];
$email = $_POST['email'];

   try{
       $stmte = $pdo->prepare("INSERT INTO $table (name,email) VALUES (?, ?)");
       $stmte->bindParam(1, $name , PDO::PARAM_STR);
       $stmte->bindParam(2, $email , PDO::PARAM_STR);
       $execute = $stmte->execute();
 
       if($execute){
           echo 'Dados inseridos com sucesso';
		   header('location: index.php');
       }
       else{
           echo 'Erro ao inserir os dados';
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
}
?>

