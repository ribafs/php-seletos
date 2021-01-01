<?php

require_once('connection.php');

$sql='select * from clientes';

$sth = $pdo->query($sql);
$numregs = $sth->rowCount();

$sth = $pdo->query($sql);
$numfields = $sth->columnCount();

$select = $pdo->query($sql);
$meta = $select->getColumnMeta(0);
$field = $meta['name'];
 
print $field;
