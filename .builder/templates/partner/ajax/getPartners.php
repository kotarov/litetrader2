<?php
$where = '';
if(isset($_REQUEST['id'])) $where = " WHERE p.id = ".(int)$_REQUEST['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$sth = $dbh->query("SELECT 
    __SELECT_ACTIVE__
    __SELECT_ADVERTISE__
    p.name || ' ' || p.family name,
    __SELECT_PHONE__
    p.email,
    __SELECT_PHOTO__
    __SELECT_ADDRESS__
    __SELECT_COMPANY__
    __SELECT_CART__
    p.id actions,
    p.id
FROM partners p $where");


$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);
return json_encode($ret);