<?php
	include_once('./connection.inc.php');
	print '<link rel="stylesheet" href="style_print.css" type="text/css" media="screen,print">';
	include_once('./functions.inc.php');

	if(isset($_POST[sendQuery])){
	$title = $_POST[title];
	$logo = $_POST[logo];
	$rpp = $_POST[rpp];
	$border = $_POST[border];
	$table = $_POST[table];
	$query = $_POST[endQuery];

	$pk = primary_key($table);

	if($sgbd=='my'){
		$res= mysql_query($query); 
		$nf = mysql_num_fields($res);
		$nr = mysql_num_rows($res); 
	}elseif($sgbd=='pg'){
		$res= pg_query($query); 
		$nf = pg_num_fields($res);
		$nr = pg_num_rows($res); 
	}

	if($rpp==0){
		print "Favor informar a quantidade de registros por página!";
		exit;
	}else{
		$pages = $nr%$rpp;
	}

	// Labels
	echo '<body>';

	if(!isset($logo)){// Title
		echo '<h2 align="center">$title</h2>';
	}else{ // Logo
		echo "<br><center><img src=\"$logo\" border=\"0\"></center><br>";
	}
	echo "<table border=\"$border\" align=\"center\"><tr>";	

	$i = 0; 
	if($sgbd=='my'){		
		while($i < mysql_num_fields($res))
		{			
		    $column = mysql_field_name($res,$i);
			echo "<td><b>&nbsp;".ucfirst($column)."&nbsp;</b></td>";
		    $i++;
		}
	}elseif($sgbd=='pg'){
		while($i < pg_num_fields($res))
		{			
		    $column = pg_field_name($res,$i);
			echo "<td><b>&nbsp;".ucfirst($column)."&nbsp;</b></td>";
		    $i++;
		}
	}
	function fetch_array($res){
		global $sgbd;
		if($sgbd=='my'){	
			return mysql_fetch_array($res);
		}elseif($sgbd=='pg'){	
			return pg_fetch_array($res);
		}
	}
	// Values
	$r = 0;
	$p = 0;
	while($field = fetch_array($res)){
		$i =0;
		if($sgbd=='my'){	
			if( (($r%$rpp) == 0) && ($r > ($rpp-1)) ) {
				print "<tr style=\"page-break-before:always\"><tr>";
				$p ++;
			}else{
				print "<tr>";
			}

		    while($i < mysql_num_fields($res)){
		        $column = mysql_field_name($res,$i);
		        $type = mysql_field_type($res,$i);
					if($lang == 'br'){
					if($type == 'date') {
						$dt = explode('-',$field[$i]);
						$datefield = $dt[2].'/'.$dt[1].'/'.$dt[0]; 
				        echo "<td>&nbsp;".$datefield."&nbsp;</td>";
					}elseif($type != 'blob'){
				        echo "<td>&nbsp;".$field[$i]."&nbsp;</td>";
					}
				}else{
			        echo "<td>&nbsp;".$field[$i]."&nbsp;</td>";
				}
		        $i++;
		    }
		}elseif($sgbd=='pg'){
			if( (($r%$rpp) == 0) && ($r > ($rpp-1)) ) {
				print "<tr style=\"page-break-before:always\"><tr>";
			}else{
				print "<tr>";
			}
	
	    while($i < pg_num_fields($res)){
	        $column = pg_field_name($res,$i);
	        $type = pg_field_type($res,$i);

			if($lang == 'br'){
				if($type == 'date') {
					$dt = explode('-',$field[$i]);
					$datefield = $dt[2].'/'.$dt[1].'/'.$dt[0]; 
			        echo "<td>&nbsp;".$datefield."&nbsp;</td>";
				}else{
			        echo "<td>&nbsp;".$field[$i]."&nbsp;</td>";
				}
			}else{
		        echo "<td>&nbsp;".$field[$i]."&nbsp;</td>";
			}
	       $i++;

	    }
	}
	$r ++;

	echo "</tr>";
   }/* end while($field = mysql_fetch_array($res)){ */
   echo "</table>";
}
print '<a href="../../menu.php">Menu</a>';
?>
