<?php

if(!isset($_GET['id'])) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'supplies');
$sth = $dbh->query("SELECT 
    id,
    icon,
    name,
    color,
    is_closed
FROM statuses
WHERE id = ".(int)$_GET['id']);

$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
