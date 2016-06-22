<?php
/*
 * expects: $status = array('id_order','id_status');
 *
 */

$dbh = new PDO('sqlite:'.DB_DIR.'sales');
$status['status'] = $dbh->query("SELECT name from statuses WHERE id = ".$status['id_status'])->fetch(PDO::FETCH_COLUMN);
$status['user'] = $_SESSION['admin']['name'].' '.(isset($_SESSION['admin']['surname']) ? $_SESSION['admin']['surname']:'').' '.$_SESSION['admin']['family'];
$status['project'] = 'admin';
$status['date_add'] = time();

$sth = $dbh->prepare("INSERT INTO orders_statuses (".implode(',', array_keys($status)).") VALUES (:".implode(", :", array_keys($status)).");");
$sth->execute($status);