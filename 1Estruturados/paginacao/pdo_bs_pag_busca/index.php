<?php
require_once('header.php');

require_once('connection.php');
define("ROW_PER_PAGE",10);
// Paginação

	$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	$sql = 'SELECT * FROM clientes WHERE nome LIKE :keyword';// OR email LIKE :keyword OR data_nasc LIKE :keyword OR cpf LIKE :keyword ORDER BY id DESC ';
	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * ROW_PER_PAGE;
	}
if($sgbd=='mysql'){
	$limit=" limit " . $start . "," . ROW_PER_PAGE;
}else{
	$limit=" offset " . $start . " limit " . ROW_PER_PAGE;
}
	$pagination_statement = $pdo->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/ROW_PER_PAGE);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
				} else {
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$pdo_statement = $pdo->prepare($query);
	$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<div class="container">

<div class="row">
    <div class="col-md-3">
    <a href="add.php" class="btn btn-primary">Novo Cliente</a>
    </div>
    <div class="col-md-9" style='text-align:right;'>
        <form name='frmSearch' action='' method='post'>
        <input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25' placeholder="Procure pelo nome">
    </div>
</div>

<table class='tbl-qa table table-hover'>
  <thead>
	<tr>
<?php
	$sql = 'SELECT * FROM clientes';
        $sth = $pdo->query($sql);
        $numfields = $sth->columnCount();
        
        for($x=0;$x<$numfields;$x++){
            $meta = $sth->getColumnMeta($x);
            $field = $meta['name'];
?>
	  <th><?=ucfirst($field)?></th>
	<?php
        }
print  "</thead>
  <tbody id='table-body'>
	  <tr class='table-row'>";

	if(!empty($result)) { 

		foreach($result as $row) {

            for($x=0;$x<$numfields;$x++){
                $meta = $sth->getColumnMeta($x);
                $field = $meta['name'];

?>
            <td><?=$row[$field]?></td>
    <?php
            }
?>
            <td><a href="update.php?id=<?=$row['id']?>"><i class="glyphicon glyphicon-edit" title="Editar"></a></td>
            <td><a href="delete.php?id=<?=$row['id']?>"><i class="glyphicon glyphicon-remove-circle" title="Excluir"></a></td></tr>
<?php
		}
	}
	?>
  </tbody>
</table>
<?php echo $per_page_html; ?>
</form>
</div>
<?php require_once('footer.php'); ?>

