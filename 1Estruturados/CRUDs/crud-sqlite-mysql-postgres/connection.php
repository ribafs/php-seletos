<?php
	$host = 'localhost'; //sqlite não usa
	$db   = 'testes'; //sqlite não usa
	$user = 'root'; //sqlite não usa
	$pass = ''; //sqlite não usa
	$sgbd = 'sqlite';// sqlite, mysql, pgsql
	$port = 3306; // 3306, 5432, sqlite não usa

	$regsPerPage = 23; // Registros por página
    $linksPerPage = 8;
    $appName = 'Cadastro de Clientes';
    $title = 'CRUD em PHP com OO e bons recursos';

    switch ($sgbd){
		case 'mysql':
			try {
				$dsn = $sgbd.':host='.$host.';dbname='.$db.';port='.$port;
				$pdo = new PDO($dsn, $user, $pass);
				// Boa exibição de erros
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$pdo->query('SET NAMES utf8');

			}catch(PDOException $e){
                // Usar estas linhas no catch apenas em ambiente de testes/desenvolvimento. Em produção apenas o exit()
				echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
				echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
				echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
				echo '<b>Linha</b>: '.$e->getLine().'<br>';
				exit();
			}
			break;
		case 'sqlite':
			try {
	            $pdo = new PDO('sqlite:db/sqlite3.db');
	            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	            $query = "CREATE TABLE IF NOT EXISTS customers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name TEXT, email TEXT, city TEXT)";
	            $pdo->exec($query);
			}catch(PDOException $e){
                // Usar estas linhas no catch apenas em ambiente de testes/desenvolvimento. Em produção apenas o exit()
				echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
				echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
				echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
				echo '<b>Linha</b>: '.$e->getLine().'<br>';
				exit();
			}
			break;
		case 'pgsql':
			try {
				$dsn = $sgbd.':host='.$host.';dbname='.$db.';port='.$port;
				$pdo = new PDO($dsn, $user, $pass);
				// Boa exibição de erros
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
					echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
					echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
					echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
					echo '<b>Linha</b>: '.$e->getLine().'<br>';
					exit();
			}
			break;
		case 'default':
			break;
	}

