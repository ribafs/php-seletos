<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Lista de Clientes - PDO</title>
 </head>

<?php
function __autoload($class){
	include_once('../'.$class.".php");	
}
//include_once("pdoCrud.php");

$obj=new pdoCrud;
if(isset($_REQUEST['status'])){
 echo"Atualização bem sucedida";
}

if(isset($_REQUEST['status_insert'])){
 echo"Cadastro bem sucedido";
}

if(isset($_REQUEST['del_id'])){
	if($obj->delete($_REQUEST['del_id'],"clientes")){
		echo"Registro excluído com sucesso";
	}
}
?>

 <a href="../index.html">Menu</a>&nbsp;<a href="index.php">Início</a>&nbsp;<a href="insert.php">Inserir</a>
 <h3 >Todos os Registros</h3>

<table width="750" border="1">
 <tr class="success">
 <th scope="col">ID</th>
 <th scope="col">CPF</th>
 <th scope="col">Nome</th>
 <th scope="col">Crédito</th>
 <th scope="col">Nascimento</th>
 <th scope="col">E-mail</th>
 <th scope="col">Ação</th>
 </tr>

<?php
 foreach($obj->select("clientes") as $value){
 extract($value);
 echo <<<show
 <tr class="success">
 <td>$id</td>
 <td>$cpf</td>
  <td><a href="update.php?id=$id">$nome</a></td>
 <td>$credito_liberado</td>
 <td>$data_nasc</td>
 <td>$email</td>
 <td><a href="update.php?id=$id">Editar</a>&nbsp;&nbsp;
 <a href="index.php?del_id=$id">Excluir</a></td>
 </tr>
show;
 }
?>

<tr class="success">
 <th scope="col" colspan="5" align="right">
 <div class="btn-group"><a href="insert.php">Adicionar Cliente</a></div>
 </th>
 </tr>
 </table>
</div>
<body>
</body>
</html>