<?php

	$host  = 'localhost';
	$db    = 'testes';
	$user  = 'root';// root, postgres
	$pass  = ''; // postgres
	$sgbd  = 'mysql'; // mysql, pgsql
	$port  = '3306'; // 3306, 5432
	$table = 'customers';

	$regsPerPage = 8; // Registros por página
    $linksPerPage = 23;
    $appName = 'Gerador de CRUDs com PHPOO</a>';

    function connection(){
        global $sgbd,$host,$db,$port,$user,$pass;
		switch ($sgbd){
			case 'mysql':
				try {
					$dsn = $sgbd.':host='.$host.';dbname='.$db.';port='.$port;
					$pdo = new PDO($dsn, $user, $pass);
					// Boa exibição de erros
					$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
					$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$pdo->query('SET NAMES utf8');
					return $pdo;

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

					return $pdo;

				}catch(PDOException $e){
					echo '<br><br><b>Código</b>: '.$e->getCode().'<hr><br>';
					echo '<b>Mensagem</b>: '. $e->getMessage().'<br>';
					echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
					echo '<b>Linha</b>: '.$e->getLine().'<br>';
					exit();
				}
				break;

			case 'sqlite':
				try {
					$pdo = new PDO('sqlite:/db/sqlite3.db'); // Caminho do banco em sqlite

					// Boa exibição de erros
					$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
					$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					return $pdo;

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
	}

    // Copiar uma pasta com todos os arquivos e subpastas recursivamente
    // Crédito - https://stackoverflow.com/questions/2050859/copy-entire-contents-of-a-directory-to-another-using-php#2050909
    function copyDir($src,$dst) { 
        $dir = opendir($src); 
        mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    } 
    // Caso a pasta de destino não exista será criada
    // copyDir('j381/installation', 'joomla3/installation');

    // Nomes das tabelas do banco atual
	function tableNames(){
		try {
		  if($sgbd=='mysql'){
 		    $sql="SHOW TABLES";
		  }elseif($sgbd=='pgsql'){
			$sql="SELECT relname FROM pg_class WHERE relname !~ '^(pg_|sql_)' AND relkind = 'r';";
		  }elseif($sgbd=='sqlite'){
            $sql='SELECT name FROM sqlite_master WHERE type = "table"';
          }
		  $tableList = array();		  
		  $res = $pdo->prepare($sql);
		  $res->execute();
		  while($cRow = $res->fetch())
		  {
			$tableList[] = $cRow[0];
		  }
		  return $tableList;// array
		}catch (PDOException $p){
			print $p->getMessage();
			exit;
		}
	}

