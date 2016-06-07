<?php

if(!isset($_GET['id'])) exit; 

$dbh = new PDO('sqlite:'.DB_DIR.'products');
$sth = $dbh->prepare("SELECT 
    items.id,
    items.title,
    items.description,
    items.reference,
    items.id_category,
    unit.abbreviation unit,
    items.price,
    items.qty,
    unit.abbreviation unit, 
    
    items.tags AS 'tags[]'
    
FROM items items 
LEFT JOIN units unit ON (items.id_unit = unit.id)  
WHERE items.id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
