<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Atualizar Funcionário - PDO</title>
 </head>
<body>

<?php
function __autoload($class){
	include_once('../'.$class.".php");	
}

$obj=new pdoCrud;
if(isset($_REQUEST['update'])){
 extract($_REQUEST);
 $update="UPDATE funcionarios SET cpf=:cpf,nome=:nome,senha=:senha,email=:email,data_nasc=:data_nasc,empresa=:empresa WHERE id=:id";
 $execute=array(':id'=>$id,':cpf'=>$cpf,':nome'=>$nome,':senha'=>$senha,':email'=>$email,':data_nasc'=>$data_nasc,':empresa'=>$empresa);

 if($obj->update($update,$execute)){
 header("location:index.php?status=success");
 }
}
extract($obj->selectOne($_REQUEST['id'],"funcionarios"));
echo <<<show
 <a href="index.php">Início</a>
 <h3>Edite Seus Dados</h3>
 <form action="update.php" method="post">
 <table width="500" border="1">
 <tr>
 <th scope="row">Id</th>
 <td><input type="text" name="id" value="$id" readonly="readonly"></td>
 </tr>
 <tr>
 <th scope="row">CPF</th>
 <td><input type="text" name="cpf" value=$cpf></td>
 </tr>
 <tr>
 <th scope="row">Nome</th>
 <td><input type="text" name="nome" value="$nome"></td>
 </tr>
 <tr>
 <th scope="row">Senha</th>
 <td><input type="text" name="senha" value="$senha"></td>
 </tr>
 <tr>
 <th scope="row">E-mail</th>
 <td><input type="text" name="email" value="$email"></td>
 </tr>
 <tr>
 <th scope="row">Nascimento</th>
 <td><input type="text" name="data_nasc" value=$data_nasc></td>
 </tr>
 <tr>
 <th scope="row">Empresa</th>
 <td><input type="text" name="empresa" value="$empresa"></td>
 </tr>
 <tr>
 <th scope="row">&nbsp;</th>
 <td><input type="submit" name="update" value="Atualizar"></td>
 </tr>
 </table>
 </form>
</div>
show;
?>
</body>
</html>
