<?php

if(!isset($_GET['id'])) exit; 

$dbh = new PDO('sqlite:'.DB_DIR.'products');
$sth = $dbh->prepare("SELECT 
    items.id,
    items.title,
    items.description,
    items.reference,
    items.id_category,
    items.id_unit,
    items.price,
    items.qty,
    
    
    items.tags AS 'tags[]'
    
FROM items items 


WHERE items.id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
