<?php
if(!isset($_GET['id'])) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'blog');
$sth = $dbh->prepare("SELECT 
    i.id,
    i.name,
    i.size,
    i.is_cover,
    i.date_add
FROM images i 
WHERE id_item = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);