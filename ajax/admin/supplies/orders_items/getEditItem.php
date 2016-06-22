<?php
if(!isset($_GET['id'])) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'supplies');
$dbh->query('ATTACH DATABASE "'.DB_DIR.'products" AS "pr"');

$sth = $dbh->query("SELECT 
    sp.id,
    sp.id_item,
    sp.note,
    p.id||'. '||p.title item,
    p.date_add image,
    sp.id_unit,
    sp.qty,
    sp.price
FROM orders_items sp 
LEFT JOIN pr.items p ON (p.id = sp.id_item) 
WHERE sp.id = ".(int)$_GET['id']);


$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
