<?php

// recursive file copy
// http://www.php.net/manual/pt_BR/function.copy.php
function recurse_copy($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
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

/* PAGINAÇÃO DE RESULTADOS DE UM BANCO DE DADOS MYSQL 
Na versão 2.0 foi melhorada por Cássio Henrique Jorge cassiohj@yahoo.com.br 
A nova versão foi incluído os links para Primeiro e Último e melhorado a seção de contagem 
de registros da tabela utilizando a função COUNT() do MySQL para torar o códugo ainda mais 
rápido que utilizar SELECT * 
Mostra links para 5 páginas anteriores e 5 posteriores, além do link Anterior e Próxima 
Autor: Flavio Cambraia - flavio@brazilsoftware.com.br 

Adaptado para PostgreSQL por Ribamar FS - ribafs@gmail.com
*/ 

function paging ($tr,$rpp,$pg) { // $tr - total_records and $rpp - registers per page 
  global $table;
  if ($tr%$rpp==0){$pages = intval($tr / $rpp)-1;} else {$pages = intval($tr / $rpp);} // calc pages necessary

  if ($tr>0){ 
     $NumStartRegister = ($pg*$rpp)+1; 
     if ($pg <> $pages) {$NumEndRegister = ($pg*$rpp)+$rpp;} else {$NumEndRegister = $tr;} 

     if ($pg <> 0) { 
       $showpage = $pg - 1; 
       echo "<a href=".$PHP_SELF."?table=".$table."&pg=0 title='first'>&nbsp;<img src='./images/first.jpg' alt='first' title='first' border='0'></a>&nbsp;"; 
       echo "<a href=".$PHP_SELF."?table=".$table."&pg=".$showpage." title='previous'> &nbsp;<img src='./images/prev.jpg' alt='previous' title='previous' border='0'></a>&nbsp;"; 
     }else{
       $showpage = $pg; 
       echo "&nbsp;<img src='./images/first_dis.jpg' alt='first' title='first' border='0'>&nbsp;"; 
       echo "&nbsp;<img src='./images/prev_dis.jpg' border='0'>&nbsp;"; 
	 } 
     for ($i = $pg-5; $i<$pg; $i++) { 
        $showpage=$i+1; 
        if ($i>=0) { 
           echo '<a href="'.$PHP_SELF.'?table='.$table.'&pg='.$i.'">'.$showpage.'</a>'; 
           echo '&nbsp;&nbsp;'; 
        } 
     } 
     for ($i = $pg; ($i<=$pages AND $i<=($pg+5)); $i++) { 
        $showpage=$i+1; 
        if ($i == $pg) { 
           echo $showpage;
		} else { 
           echo '<a href="'.$PHP_SELF.'?table='.$table.'&pg='.$i.'">'.$showpage.'</a>'; 
           echo '&nbsp;&nbsp;'; 
        } 
     } 
     if ($pg < $pages) { 
        $showpage = $pg + 1; 
        echo "<a href=".$PHP_SELF."?table=".$table."&pg=".$showpage." title='next'>&nbsp;<img src='./images/next.jpg' title='next' alt='next' border='0'></a>&nbsp;"; 
        echo "<a href=".$PHP_SELF."?table=".$table."&pg=".$pages." title='last'>&nbsp;<img src='./images/last.jpg' title='last' alt='last' border='0'></a>&nbsp;"; 
     }else{
       $showpage = $pg; 
       echo "&nbsp;<img src='./images/last_dis.jpg' border='0'>&nbsp;"; 
       echo "&nbsp;<img src='./images/next_dis.jpg' border='0'>&nbsp;"; 
	 } 
     echo "&nbsp;Total: $tr"; 

  } 
} 

// Remove directory recursively from php manual - php.net
function SureRemoveDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }

    closedir($dh);
    if ($DeleteMe){
        @rmdir($dir);
    }
}

// Return permissions of file
function file_perms($file){
	if(file_exists($file)){
		if(strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN'){
			$perm = substr(decoct(fileperms($file)),2);
			return $perm;
		}
	}else{
		return false;			
	}
}
/*
if(file_perms(__FILE__) =='0707' || file_perms(__FILE__) =='0777'){
	print file_perms(__FILE__);
}else{
	print "Sem permissão de escrita. A permissão atual é de ".file_perms(__FILE__)." altere para 0707 ou 0777";
}
*/


// Return fields and table referenceds only of the first field with FK
function foreign_key($table){
	global $database, $sgbd;
	if($sgbd=='my'){
		$sql="SELECT COLUMN_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE c
			WHERE c.TABLE_SCHEMA = '$database' AND c.TABLE_NAME = '$table' AND not isnull(REFERENCED_TABLE_NAME)";

		$qry=mysql_query($sql);

		$row=0;
		$regs=array();
		$nf=mysql_num_fields($qry);
		while ($data = mysql_fetch_array($qry)) {
			for($x=0;$x < $nf;$x++){
				array_push($regs, $data[$x]);
			}
	   		$row++;
		}	

		return $regs;
	}elseif($sgbd=='pg'){
		$sql="SELECT kcu.column_name as local_field,
		   		ccu.table_name AS references_table,
				  ccu.column_name AS references_field
			 FROM information_schema.table_constraints tc
		LEFT JOIN information_schema.key_column_usage kcu
			   ON tc.constraint_catalog = kcu.constraint_catalog
			  AND tc.constraint_schema = kcu.constraint_schema
			  AND tc.constraint_name = kcu.constraint_name
		LEFT JOIN information_schema.referential_constraints rc
			   ON tc.constraint_catalog = rc.constraint_catalog
			  AND tc.constraint_schema = rc.constraint_schema
			  AND tc.constraint_name = rc.constraint_name
		LEFT JOIN information_schema.constraint_column_usage ccu
			   ON rc.unique_constraint_catalog = ccu.constraint_catalog
			  AND rc.unique_constraint_schema = ccu.constraint_schema
			  AND rc.unique_constraint_name = ccu.constraint_name
			WHERE tc.table_name = '$table'
			and tc.constraint_type='FOREIGN KEY';
		";
		/* Adapted from: http://www.alberton.info/postgresql_meta_info.html */

		$qry=pg_query($sql);

		//$row=0;
		$regs=array();
		$nf=pg_num_fields($qry);
		while ($data = pg_fetch_array($qry)) {
			for($x=0;$x < $nf;$x++){
				array_push($regs, $data[$x]);
			}
	   		//$row++;
		}	
		return $regs;
	}
}
/*
$table='prateleiras';
$ret = foreign_key($table);
$nrfk = count($ret);
print "FldLoc1 - ".$ret[0].'<br>';
print "TabRef1 - ".$ret[1].'<br>';
print "FldRef1 - ".$ret[2].'<br>';
print "FldLoc2 - ".$ret[3].'<br>';
print "TabRef2 - ".$ret[4].'<br>';
print "FldRef2 - ".$ret[5].'<br>';
//...
*/

//dropdown
function combo($field, $default_value = null, $table)
{
	//this code is bringing in the values for the dropdown. 
	$query="select * from $table order by $field"; 

	/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */ 
	if($sgbd=='my'){
		$result = mysql_query ($query); 
		while($row=mysql_fetch_array($result)){//Array or records stored 
			if($row[$field] == $default_value)
			{
				$combo .= "<option value=$row[0] selected='selected'>$row[$field]</option>"; 
			}else{
				$combo .= "<option value=$row[0]>$row[$field]</option>"; 
			}
		} 
		return $combo;
	}elseif($sgbd=='pg'){	
		$result = pg_query ($query); 
		while($row=pg_fetch_array($result)){//Array or records stored 
			if($row[$field] == $default_value)
			{
				$combo .= "<option value=$row[0] selected='selected'>$row[$field]</option>"; 
			}else{
				$combo .= "<option value=$row[0]>$row[$field]</option>"; 
			}
		} 
		return $combo;
	}
}
// Adapted from: http://codingforums.com/showthread.php?t=161047
//print combo('clientes','nome',$default_value = 'Elias Pereira Brito');


// Write string in file
function write_string($arquivo,$str){
	$fp = fopen($arquivo, "w");
	$ret=fwrite($fp, $str); // grava a string no arquivo. Se o arquivo não existir ele será criado
	if(!$ret) ////print "Erro ao gravar no arquivo!";
	fclose($fp);
}

// Original in: http://www.scriptbrasil.com.br/forum/lofiversion/index.php/t62271.html
function table_names(){	
	global $database,$sgbd;

	if($sgbd=='my'){
		$resultado_tabelas = mysql_list_tables($database);
		$qntd_tabelas = mysql_numrows($resultado_tabelas);

		for ($i = 0; $i < $qntd_tabelas; $i++)
		{
			$tables .= mysql_tablename($resultado_tabelas, $i).',';
		}
		return $tables;
	}elseif($sgbd=='pg'){
		$resultado_tabelas = pg_query("SELECT relname FROM pg_class WHERE relname !~ '^(pg_|sql_)' AND relkind = 'r';");
		$qntd_tabelas = pg_num_rows($resultado_tabelas);

		$tables='';
		while ($row = pg_fetch_array($resultado_tabelas))
		{ 
		 	$tables .= $row[0].',';
		} 
		return $tables;
	}
}	
//print_r(table_names());


// Retorna o tamanho dos campos na tabela
function field_len($table,$nr_field){
$sql="
SELECT a.attnum AS ordinal_position,
         a.attname AS field,
         t.typname AS type,
         a.attlen AS max_character_maximum_length,
         a.atttypmod AS len
    FROM pg_class c,
         pg_attribute a,
         pg_type t
   WHERE c.relname = '$table'
     AND a.attnum > 0
     AND a.attrelid = c.oid
     AND a.atttypid = t.oid
ORDER BY a.attnum;
";

	$result=pg_query($sql);
	$nr=pg_num_rows($result);

	for($x=0;$x<$nr;$x++){
		$arr = pg_fetch_array($result);
		if($arr["type"]=='int2' || $arr["type"]=='int4' || $arr["type"]=='int8' || $arr["type"]=='numeric'){
			$len .= '12'.',';
		}elseif($arr["type"]=='bpchar' || $arr["type"]=='varchar'){
			$len .= ($arr["len"]-4).',';
		}elseif($arr["type"]=='date'){
			$len .= '8'.',';
		}elseif($arr["type"]=='time'){
			$len .= 5;
		}elseif($arr["type"]=='timestamp'){
			$len .= '13'.',';
		}	
	}

	$len=explode(',',$len);
	$len=$len[$nr_field];

	return $len;
}
/*
for ($j = 1; $j < 6; $j++) {
    $len = field_len('clientes', $j-1);
	print "<input name=\"$fieldname\" type=\"text\" size=\"$len\" maxlength=\"$len\" ></td></tr>\n";	
}
*/


// Original in http://www.daniweb.com/forums/thread78890.html
function highlight($content,$query,$color='blue'){
   $query=explode(' ',$query);
   for($i=0;$i<sizeOf($query);$i++)
   $content=preg_replace("/($query[$i])/i","<b><font color=".$color.">\${1}</font></b>",$content);
   return $content;
}

// Return primary key field name
function primary_key($table){
	global $database,$sgbd;

	if($sgbd=='my'){
		$sql="SELECT c.COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE c
			WHERE c.TABLE_SCHEMA = '$database'
			AND c.TABLE_NAME = '$table' AND c.CONSTRAINT_NAME = 'PRIMARY'";
		
		$qry=mysql_query($sql);
		$reg=mysql_fetch_array($qry);	
		$ret=$reg[0];

		return $ret;
	}elseif($sgbd=='pg'){	
		$str="SELECT ta.attname AS column_name
			FROM pg_class bc, pg_index i, pg_attribute ta, pg_attribute ia
			WHERE bc.oid = i.indrelid AND ia.attrelid = i.indexrelid AND ta.attrelid = bc.oid AND bc.relname = '$table'
			AND ta.attrelid = i.indrelid AND ta.attnum = i.indkey[ia.attnum-1]
			ORDER BY column_name;
		";

		$qry = pg_query($str);

		$reg = pg_fetch_array($qry,$x);
		$ret=$reg[0];

		return $ret;
	}
}

// Return only text fields 
function fields_text($result){
	global $sgbd;

	if($sgbd=='my'){
		$i = mysql_num_fields($result);
			for ($j = 0; $j < $i; $j++) {
			    $fieldname = mysql_field_name($result, $j);
				$type=mysql_field_type($result, $j);

				if($type=='string' || $type=='date' || $type=='time' || $type=='timestamp'){
					$ftype .= $fieldname.',';
				}
			}
		return $ftype;
	}elseif($sgbd=='pg'){
		$i = pg_num_fields($result);
			for ($j = 0; $j < $i; $j++) {
			    $fieldname = pg_field_name($result, $j);
				$ftype .= $fieldname.',';
			}
		return $ftype;
	}
}

?>
