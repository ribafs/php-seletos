<?php
include_once("classes/crud.php");
$crud = new Crud($pdo);

if (isset($_POST["page"])) {
    $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_no))
        die("Error fetching data! Invalid page number!!!");
} else {
    $page_no = 1;
}

// get record starting position
$start = (($page_no-1) * $crud->linksPerPage);//$row_limit);

$results = $pdo->prepare("SELECT * FROM customers ORDER BY id LIMIT $start, $crud->linksPerPage");
$results->execute();

while($row = $results->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>" . 
    "<td>" . $row['id'] . "</td>" . 
    "<td>" . $row['name'] . "</td>" . 
    "<td>" . $row['email'] . "</td>" . 
    "<td>" . $row['city'] . "</td>";?>

	    <td><a href="update.php?id=<?=$row['id']?>"><i class="glyphicon glyphicon-edit" title="Editar"></a></td>
	    <td><a href="delete.php?id=<?=$row['id']?>"><i class="glyphicon glyphicon-remove-circle" title="Excluir"></a></td>
<?php
print "
    </tr>";
}
?>
