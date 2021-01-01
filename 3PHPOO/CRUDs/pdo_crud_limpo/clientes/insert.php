<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Inserir Clientes - PDO</title>
 </head>
<body>

<?php
function __autoload($class){
	include_once('../'.$class.".php");	
}

$obj=new pdoCrud;

if(isset($_REQUEST['insert'])){
 extract($_REQUEST);
 $insert="INSERT INTO clientes SET cpf=:cpf, nome=:nome,credito_liberado=:credito_liberado,data_nasc=:data_nasc,email=:email";
 $execute=array(':cpf'=>$cpf,':nome'=>$nome,':credito_liberado'=>$credito_liberado,':data_nasc'=>$data_nasc,':email'=>$email);
 if($obj->insert($insert,$execute)){
	header("location:index.php?status_insert=success");
 }
}
echo @<<<show
 <a href="index.php">Início</a>
 </div>
 <h3>Inserir Seus Dados</h3>
 <form action="insert.php" method="post">
 <table width="400" class="table-borderd">
 <tr>
 <th scope="row">Id</th>
 <td><input type="text" name="id" value="$id" readonly="readonly"></td>
 </tr>
 <tr>
 <th scope="row">CPF</th>
 <td><input type="text" name="cpf" value="$cpf"></td>
 </tr>
 <tr>
 <th scope="row">Nome</th>
 <td><input type="text" name="nome" value="$nome"></td>
 </tr>
 <tr>
 <th scope="row">Crédito</th>
 <td><input type="text" name="credito_liberado" value="$credito_liberado"></td>
 </tr>
 <tr>
 <th scope="row">Nascimento</th>
 <td><input type="text" name="data_nasc" value=$data_nasc></td>
 </tr>
 <tr>
 <th scope="row">E-mail</th>
 <td><input type="text" name="email" value="$email"></td>
 </tr>
 <tr>
 <th scope="row">&nbsp;</th>
 <td><input type="submit" name="insert" value="Inserir"></td>
 </tr>
 </table>
 </form>
</div>
show;
?>
</body>
</html>
