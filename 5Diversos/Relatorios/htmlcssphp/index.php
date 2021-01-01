<?php
include_once('./connection.inc.php');
include_once('./header.php');
include_once('./functions.inc.php');  

print '<link rel="stylesheet" href="./style/style_black.css" type="text/css" media="screen\">';

include_once("./lang.php"); 
if($lang=='br'){
	include_once('./languages/brazilian.php');
}elseif($lang=='en'){
	include_once('./languages/english.php');
}

$table = table_names();
$tb = explode(',',$table);
for($x=0;$x<count($tb)-1;$x++){
	$tb2 .= "<option name='$tb[$x]' value='$tb[$x]'>$tb[$x]";
}
?>
<body>
<br>
<h2><?php echo $rel_din_lng;?></h3>
<br><b><?php echo $sel_table_lng;?></b><br>
<br>
<form method="post" name="rptGen" action="">
<table border="0">
<tr><td>&nbsp;</td><td><b><?php echo $table_lng;?></b></td><td><select name=table>
<?=$tb2?>
</select>
</td><td>&nbsp;</td><td>&nbsp;</td><td><input class="submit" name="sendTable" type=submit value="OK"></td></tr>
</table>
</form>

<?php
if(isset($_POST[sendTable])){
	$table = $_POST[table];

	if($sgbd=='my') {	
		$res=mysql_query("select * from $table");
		$nf= mysql_num_fields($res);
	}elseif($sgbd=='pg'){
		$res=pg_query("select * from $table");
		$nf= pg_num_fields($res);
	}

	for($x=0;$x<$nf;$x++){
		if($sgbd=='my') {
			$fn = mysql_field_name($res,$x);
		}elseif($sgbd=='pg'){
			$fn = pg_field_name($res,$x);
		}
		$flds .= "<option value='$fn'>$fn</option>";
	}
	$query_default = "SELECT * FROM $table";

	?>

	<script type='text/javascript'>
	function msel(elem,elem2){
		if(elem.value == ''){
			elem.value = elem.value + elem2.value;
		}else{
			elem.value = elem.value + ',' + elem2.value;
		}
	}

	</script>

	<body onLoad="">
	<a href="./menu.php">Menu</a><br><br>
	<form method="post" name="rptGen" action="" onSubmit="if(returnFields.value =='' || query.value == '') {alert('<?php echo $flds_requireds_lng;?>'); return false;}">
	<INPUT type="hidden" name="table" value="<?php echo $table;?>">
	<table border="0">
	<tr><td>&nbsp;</td><td><b><?php echo $tbl_sel_lng;?>: &nbsp;</b></td><td><b><?php echo $table;?></b></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $field_lng;?></b></td><td>
		<SELECT name="fld" size="<?php echo $nf;?>" MULTIPLE onChange="msel(returnFields,this)">
			<?=$flds?>
		</SELECT>
	</td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $ret_flds_lng;?></b></td><td><input name="returnFields" type="text" size="30" value="*"><b>&nbsp;* <?php echo $all_flds_lng;?></b></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $query_lng;?></b></td><td><input name="query" type="text" value="<?php echo $query_default;?>" size="60">
	<input name="btnQuery" type="button" value="<?php echo $upd_lng;?>" onClick="if(returnFields.value == '') {alert('Favor preencher antes o campo Campos de Retorno!'); returnFields.focus(); return false;}else{query.value = 'SELECT ' + returnFields.value + ' FROM ' + '<?php echo $table;?>';};"></td></tr>

	<tr><td>&nbsp;</td><td>&nbsp;</td><td><input class="submit" name="sendField" type="submit" value="OK"></td></tr>
	</table>
	</form>
<?php
}
?>

<?php
if(isset($_POST[sendField])){
	$table = $_POST[table];
	$query = $_POST[query];

	if($sgbd=='my') {	
		$res=mysql_query("select * from $table");
		$nr = mysql_num_rows($res);
		$nf= mysql_num_fields($res);
	}elseif($sgbd=='pg'){
		$res=pg_query("select * from $table");
		$nf= pg_num_fields($res);
		$nr = pg_num_rows($res);
	}

	for($x=0;$x<$nf;$x++){
		if($sgbd=='my') {
			$fn = mysql_field_name($res,$x);
		}elseif($sgbd=='pg'){
			$fn = pg_field_name($res,$x);
		}
		$flds .= "<option value='$fn'>$fn</option>";
	}

	$pk = primary_key($table);

	$filter_default = $pk . ' > 0 AND '. $pk . ' < ' . $nr;
	$orderby_default = 'ORDER BY ' . $pk . ' ASC';
	?>

	<script type="text/javascript" language="JavaScript">
		function msel(elem,elem2){
			if(elem.value == ''){
				elem.value = elem.value + elem2.value;
			}else{
				elem.value = elem.value + ',' + elem2.value;
			}
		}

		function check_ext(campo) {
		  var ext = campo.value;
		  ext = ext.substring(ext.length-4,ext.length);
		  ext = ext.toLowerCase();
		  if(ext != '.jpg' && ext != '.png' && ext != '.gif' && ext != '') {
			alert('You selected a '+ext+ 
				  ' file; please select a png, jpg  gif or none file instead!');
			return false; 
		  }else{
			return true; 
		  }
		}
	</script>
	<body>
	<a href="./menu.php">Menu</a><br><br>

	<form method="post" name="rptGen" enctype="multipart/form-data" action="report_html_rpt.php" onSubmit="if(rpp.value=='' || endQuery.value == '') {alert ('<?php echo $flds_requireds_lng;?>'); rpp.focus(); return false;};return check_ext(this.logo);">
	<INPUT type="hidden" name="table" value="<?php echo $table;?>">
	<table border="0">
	<tr><td>&nbsp;</td><td><b><?php echo $tbl_sel_lng;?>: &nbsp;</b></td><td><b><?php echo $table;?></b></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $query_lng;?>: &nbsp;</b></td><td><input name="query" type="text" size="60" value="<?php echo $query;?>" READONLY style="color:gray"></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $field_lng;?></b></td><td>
		<SELECT name="fld">
			<?=$flds?>
		</SELECT>
	</td></tr>
	<tr><td>&nbsp;</td><td><td>&nbsp;</td></td><td><td>&nbsp;</td></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $filter_lng;?></b></td><td><input name="filter" type="text" size="60" value="<?php echo $filter_default;?>"></b></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $orderby_lng;?></b></td><td><input name="orderby" type="text" size="40" value="<?php echo $orderby_default;?>" ></td></tr>

	<tr><td>&nbsp;</td><td><b><?php echo $logo_lng;?></b></td><td><input name="logo_file" size="60" type="file" accept="image/jpeg, image/png, image/gif" style="color:black" onChange="logo.value=this.value" value="/home/ribafs/backup/public_html/fw_agil/admin/148.jpg"></td></tr>
	<input name="logo" type="hidden"> 
	<tr><td>&nbsp;</td><td><b><?php echo $rpt_title_lng;?></b></td><td><input name="title" type="text" value=""></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $rpp_lng;?></b></td><td><input name="rpp" type="text" size="2" value="">&nbsp;<b>*</b></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $border_lng;?></b></td><td><input name="border" type="text" value="1"></td></tr>
	<tr><td>&nbsp;</td><td><b><?php echo $endquery_lng;?></b></td><td><input name="endQuery" type="text" size="80" value="<?php echo $query;?>">&nbsp;<b>*</b>
<input name="btnEQuery" type="button" value="<?php echo $upd_lng;?>" onClick="if(filter.value !='') {endQuery.value = endQuery.value + ' WHERE ' + filter.value + ' ' + orderby.value;}else{endQuery.value = query.value;}"></td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td><?php echo $rpt_obs_lng;?></td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td><input class="submit" name="sendQuery" type="submit" value="OK"></td></tr>
	</table>
	</form>
<?php
}
include_once('./footer.php'); 
?>

