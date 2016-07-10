<?php
if(!isset($_GET['id'])) exit;
 

$dbh = new PDO('sqlite:'.DB_DIR.'blog');
$sth = $dbh->prepare("SELECT 
    i.name AS title,
    'image.php/'||i.id||'/thumb/'||i.date_add  AS value
FROM images i 
WHERE id_item = ".(int)$_GET['id']);
$sth->execute();
$ret = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);