<?php

if(!isset($_GET['id'])) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'supplies');
$dbh->query('ATTACH DATABASE "'.DB_DIR.'products" AS "pr"');


$sth = $dbh->query("SELECT 
    op.id,
    op.id_item image,
    op.item,
    op.note,
    op.qty,
    op.unit mu,
    op.price,
    (op.qty*op.price) total,
    op.id_order,
    op.id_item,
    op.id_unit,
    op.id
FROM orders_items op "
//.'LEFT JOIN pr.items p ON (p.id = op.id_item) '
//.'LEFT JOIN pr.units u ON (op.id_unit = u.id) '
."WHERE op.id_order = ".(int)$_GET['id']);


$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
