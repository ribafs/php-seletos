<?php

require_once 'connection.php';
$conn = new Connection();
$pdo = $conn->pdo;

/* Classe que trabalha com um crud, lidando com uma tabela por vez, que é fornecida a cada instância, desde a conexão com o banco */

class Crud extends Connection
{

	public $pdo;
	public $table;

	public function __construct($pdo, $table){
		$this->pdo = $pdo;
		$this->table = $table;
	}

    // Número de campos da tabela atual
    private function numFields(){
        $sql = 'SELECT * FROM '.$this->table.' LIMIT 1';
        $sth = $this->pdo->query($sql);
        $num_campos = $sth->columnCount();
        return $num_campos;
    }

    // Nome de campo pelo número $x
    public function fieldName($x){
        $sql = 'SELECT * FROM '.$this->table.' LIMIT 1';
        $sth = $this->pdo->query($sql);
        $meta = $sth->getColumnMeta($x);
        $field = $meta['name'];
        return $field;
    }

    // Retornar todos os nomes do form dentro de uma tabela. Assim:
    // <tr><td>Nome</td><td><input type="text" name="nome"></td></tr>
    public function formFields(){
	    $fields = '';

        for($x=1;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);

		    if($x < $this->numFields()){
                $fields .= '<tr><td>'.ucFirst($field).'</td><td><input type="text" name="'.$field.'"></td><tr>'."\n";
		    }
	    }
        return $fields;
    }
    
    // Retornar os nomes de todos os campos:
    // Exemplo: id, nome,email,nascimento,cpf
    public function fields(){
	    $fields = '';

        for($x=0;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);

            if($x < $this->numFields() -1){
                $fields .= "$field,"."\n";
	        }else{
                $fields .= "$field";
            }
	    }
        return $fields;
    }

    // Efetuar o insert no banco
    public function insert(){
        if(isset($_POST['enviar'])){

            $sql = "INSERT INTO $this->table {$this->inserirStr()}";
            $sth = $this->pdo->prepare($sql);    

            for($x=1;$x < $this->numFields();$x++){
                $field = $this->fieldName($x);
		        $sth->bindParam(":$field", $_POST["$field"], PDO::PARAM_INT);
	        }
            $execute = $sth->execute();

            if($execute){
                 print "<script>location='index.php?table=$this->table';</script>";
            }else{
                echo 'Error insert dates';
            }
        }
    }

    // Efetuar delete
    public function delete($id){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "DELETE FROM  {$this->table} WHERE id = :id";
            $sth = $this->pdo->prepare($sql);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);   

            if( $sth->execute()){
                print "<script>alert('Register '+$id+' sucessuful deleted!');location='index.php?table=$this->table';</script>";
            }else{
                print "Error on delete register!<br><br>";
            }
        }
    }

    // Efetuar update
    public function update(){

        $sql = "UPDATE {$this->table} SET {$this->updateSet()} WHERE id = :id";
        $sth = $this->pdo->prepare($sql);

        for($x=0;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);
            $sth->bindParam(":$field", $_POST["$field"], PDO::PARAM_INT);
	    }

       if($sth->execute()){
            print "<script>location='index.php?table=$this->table';</script>";
       }else{
            print "Error on update register!<br><br>";
       }
    }

    // Tipo do campo
	public function fieldType($table, $fldName){	
        $con = new Connection();
        $sgbd = $con->sgbd;

		try {
			if($sgbd =='mysql'){
				$sql="SHOW COLUMNS as col FROM $table WHERE Field = '$fldName'";
			}elseif($sgbd =='pgsql'){
				$sql="SELECT data_type as col FROM information_schema.columns WHERE table_name = '$table' and 					column_name='$fldName' ORDER BY ordinal_position;";
			}
			$res = $this->pdo->query($sql);
			$type = $res->fetch();
			return $type['col'];
		}catch (PDOException $p){
			print $p->getMessage();
			exit;
		}
	}

    // Tamanho de campo
	public function fieldLen($table,$fldName){	
        $con = new Connection();
        $sgbd = $con->sgbd;

		try {
			if($sgbd=='mysql'){
			    $sql = "SELECT character_maximum_length as len FROM INFORMATION_SCHEMA.columns where table_name='$table' and column_name='$fldName'";
			}elseif($sgbd=='pgsql'){
				$sql="SELECT character_maximum_length as len FROM information_schema.columns
				WHERE table_name = '$table' and column_name='$fldName' ORDER BY ordinal_position;";
			}
			$select = $this->pdo->query($sql);
			$field = $select->fetch();
			return $field['len'];
		}catch (PDOException $p){
			print $p->getMessage();
			exit;
		}
	}

    // Chaves estrangeiras de uma tabela
	public function primaryKey($table){	
        $con = new Connection();
        $sgbd = $con->sgbd;

		try {
			if($sgbd=='mysql'){
				$sql = $this->pdo->query("SHOW INDEX FROM $table");
			}elseif($sgbd=='pgsql'){
				$sql="SELECT kcu.column_name as Column_name FROM information_schema.table_constraints tc LEFT JOIN information_schema.key_column_usage kcu ON tc.constraint_name = kcu.constraint_name
    WHERE tc.table_name = '$table' AND constraint_type = 'PRIMARY KEY';";
			}
			$qry=$this->pdo->query($sql);
			$pk = $qry->fetch();
			return $pk['column_name'];
		}catch (PDOException $p){
			print $p->getMessage();
			exit;
		}
	}

    // Retorna somente o nume do primeiro campo da chave primária. Caso seja composta, trará somente o primeiro
	public function foreignKey(){
        $con = new Connection();
        $sgbd = $con->sgbd;

		try {
			if($sgbd=='mysql'){
            $sql = "SELECT 
  column_name
FROM
  INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE
  table_schema = DATABASE() and
  constraint_name <> 'primary' and
  TABLE_NAME ='".$this->table."';"; // Mudar o nome do banco para que fique dinâmico
			}elseif($sgbd='pgsql'){
				$sql="SELECT
    kcu.column_name
FROM 
    information_schema.table_constraints AS tc 
    JOIN information_schema.key_column_usage AS kcu
      ON tc.constraint_name = kcu.constraint_name
      AND tc.table_schema = kcu.table_schema
    JOIN information_schema.constraint_column_usage AS ccu
      ON ccu.constraint_name = tc.constraint_name
      AND ccu.table_schema = tc.table_schema
WHERE constraint_type = 'FOREIGN KEY' AND tc.table_name='$this->table';";
			}

			$res=$this->pdo->query($sql);
		    $nf = $res->columnCount();
			$row=0;
			$regs=array();

			while ($data = $res->fetch(PDO::FETCH_NUM)) {
				for($x=0;$x < $nf;$x++){
					array_push($regs, $data[$x]);
				}
		   		$row++;
			}	

			if(isset($regs[0])){			
				return $regs;// Retorna somente o primeiro campo FK
			}else{
				//print '<b>This table dont have a foreign key</b>';
                //exit;
			}
		}catch (PDOException $p){
			print $p->getMessage();
			exit;
		}
	}


// Nomes de tabelas
	public function tableNames(){
		try {
		  if($this->sgbd=='mysql'){
 		    $sql="SHOW TABLES";
		  }elseif($this->sgbd=='pgsql'){
			$sql="SELECT relname FROM pg_class WHERE relname !~ '^(pg_|sql_)' AND relkind = 'r';";
		  }
		  $tableList = array();		  
		  $res = $this->pdo->prepare($sql);
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
}
