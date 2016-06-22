<?php

if(!isset($_GET['id'])) exit; 

$dbh = new PDO('sqlite:'.DB_DIR.'blog');
$sth = $dbh->prepare("SELECT 
    items.id,
    items.title,
    items.description,
    
    items.id_category,
    
    
    
    
    
    items.tags AS 'tags[]'
    
FROM items items 


WHERE items.id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
