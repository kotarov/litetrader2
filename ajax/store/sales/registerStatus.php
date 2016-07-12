<?php
/*
 * expects: $status = array('id_order','id_status');
 *
 */

$dbh = new PDO('sqlite:'.DB_DIR.'sales');
$status['status'] = $dbh->query("SELECT name from statuses WHERE id = ".$status['id_status'])->fetch(PDO::FETCH_COLUMN);
$status['user'] = $_SESSION['store']['name'].' '.(isset($_SESSION['store']['surname']) ? $_SESSION['store']['surname']:'').' '.$_SESSION['store']['family'];
$status['project'] = 'store';
$status['date_add'] = time();

$sth = $dbh->prepare("INSERT INTO orders_statuses (".implode(',', array_keys($status)).") VALUES (:".implode(", :", array_keys($status)).");");
$sth->execute($status);