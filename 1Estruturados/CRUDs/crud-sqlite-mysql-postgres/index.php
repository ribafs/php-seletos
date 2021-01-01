<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="css/bootstrap.css">Sourcecodester</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">CRUD com SQLite, MySQL ou PostgreSQL usando PDO</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Adicionar</button>
		<br /><br/ >
		<table class="table table-bordered">
			<thead class="alert-info">
				<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Cidade</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require 'connection.php';
					$query = $pdo->prepare("SELECT * FROM customers order by id desc");
					$query->execute();
					while($fetch = $query->fetch()){
				?>
				<tr>
					<td><?php echo $fetch['name']?></td>
					<td><?php echo $fetch['email']?></td>
					<td><?php echo $fetch['city']?></td>
					<td><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#update<?php echo $fetch['id']?>"><span class="glyphicon glyphicon-edit"></span> Editar</button> <a href="delete.php?id=<?php echo $fetch['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Excluir</a></td>
				</tr>
				
				<div class="modal fade" id="update<?php echo $fetch['id']?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="update.php" method="POST">
								<div class="modal-header">
									<h3 class="modal-title">Atualizar</h3>
								</div>
								<div class="modal-body">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										<div class="form-group">
											<label>Nome</label>
											<input type="text" class="form-control" value="<?php echo $fetch['name']?>" name="name"/>
											<input type="hidden" class="form-control" value="<?php echo $fetch['id']?>" name="id"/>
										</div>
										<div class="form-group">
											<label>E-mail</label>
											<input type="text" class="form-control" value="<?php echo $fetch['email']?>" name="email"/>
										</div>
										<div class="form-group">
											<label>Cidade</label>
											<div class="form-group">                            
											<input type="text" class="form-control" value="<?php echo $fetch['city']?>" name="city"/>
											</div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
								<div class="modal-footer">
									<button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-update"></span> Atualizar</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="add.php">
					<div class="modal-header">
						<h3 class="modal-title">Adicionar</h3>
					</div>
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Nome</label>
								<input type="text" class="form-control" name="name"/>
							</div>
							<div class="form-group">
								<label>E-mail</label>
								<input type="text" class="form-control" name="email"/>
							</div>
							<div class="form-group">
								<label>Cidade</label>
								<input type="text" class="form-control" name="city"/>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button class="btn btn-primary" name="save">Salvar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
