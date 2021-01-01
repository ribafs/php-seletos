<?php
require_once('includes/connection.php');
require_once('includes/header.php');

try{
    $stmte = $pdo->query("SELECT * FROM $table order by id desc");
    $execute = $stmte->execute();
?>
    <br>
    <h2 class="text-center">CRUD em PHP com bons recursos</h2>
    <hr>
    <!-- Form de busca-->
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <form action="search.php" method="get" >
              <div class="pull-right top">
              <span class="pull-right">  
                <label class="control-label" for="palavra" style="padding-right: 5px;">
                  <input type="text" value="" placeholder="Nome ou parte" class="form-control" name="keyword">
                </label>
                <button class="btn btn-primary btn-sm">Busca</button>&nbsp;
              </span>                 
              </div>
            </form>
        </div>
    </div>
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <table class="table table-striped table-sm table-bordered table-hover"> 
    <tr><td><b>ID</td><td><b>Name</td><td><b>E-mail</td><td colspan="2" align="center">Ação</td></tr>

<?php
    if($execute){
        while($reg = $stmte->fetch())
        {
?>
            <tr><td><?=$reg->id?></td>
            <td><?=$reg->name?></td>
            <td><?=$reg->email?></td>
            <td><a href="update.php?id=<?=$reg->id?>">Editar</a></td>
            <td><a href="delete.php?id=<?=$reg->id?>">Excluir</a></td></tr>
<?php
       }
       print '</table>
   </div>
</div>';
    }else{
           echo 'Erro ao inserir os dados';
    }
}catch(PDOException $e){
      echo $e->getMessage();
}
