<?php
include_once("classes/crud.php");

$crud = new Crud($pdo);

$stmt = $crud->pdo->prepare("SELECT COUNT(*) FROM customers");
$stmt->execute();
$rows = $stmt->fetch();

// get total no. of pages
$total_pages = ceil($rows[0]/$crud->linksPerPage);//$row_limit);
?>

<?php require_once 'header.php';?>
<body>
<br/>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><?=$conn->title?></h3></div>

            <!-- Adicionar registro -->
            <div class="text-left col-md-2 top">
                <a href="insert.php" class="btn btn-primary pull-left">
                    <span class="glyphicon glyphicon-plus"></span> Adicionar
                </a>
            </div>

            <!-- Form de busca-->
            <div class="col-md-10">
                <form action="search.php" method="get" >
                  <div class="pull-right top">
                  <span class="pull-right">  
                    <label class="control-label" for="palavra" style="padding-right: 5px;">
                      <input type="text" value="" placeholder="Name ou parte" class="form-control" name="keyword">
                    </label>
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Busca</button>&nbsp;
                  </span>                 
                  </div>
                </form>
            </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody id="pg-results">
            </tbody>
        </table>
        <div class="panel-footer text-center">
            <div class="pagination"></div>
        </div>
    </div>
</div>
    
<script src="assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bootpag.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#pg-results").load("fetch_data.php");
    $(".pagination").bootpag({
        total: <?php echo $total_pages; ?>,
        page: 1,
        maxVisible: 5
    }).on("page", function(e, page_num){
        e.preventDefault();
        /*$("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');*/
        $("#pg-results").load("fetch_data.php", {"page": page_num});
    });
});
</script>

<?php require_once 'footer.php';?>
