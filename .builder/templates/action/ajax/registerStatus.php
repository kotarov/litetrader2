<?php
/*
 * expects: $status = array('id_order','id_status');
 *
 */

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$status['status'] = $dbh->query("SELECT name from statuses WHERE id = ".$status['id_status'])->fetch(PDO::FETCH_COLUMN);
$status['user'] = $_SESSION['__PROJECT__']['name'].' '.(isset($_SESSION['__PROJECT__']['surname']) ? $_SESSION['__PROJECT__']['surname']:'').' '.$_SESSION['__PROJECT__']['family'];
$status['project'] = '__PROJECT__';
$status['date_add'] = time();

$sth = $dbh->prepare("INSERT INTO orders_statuses (".implode(',', array_keys($status)).") VALUES (:".implode(", :", array_keys($status)).");");
$sth->execute($status);