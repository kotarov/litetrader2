<?php

if(!isset($_GET['id'])) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$sth = $dbh->query("SELECT 
    i.id,
    i.id_item,
    i.name,
    i.type,
    i.size,
    i.is_cover,
    i.date_add,
    p.title item
FROM images i 
LEFT JOIN items p ON (i.id_item = p.id) 
WHERE i.id = ".(int)$_GET['id']);

$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);