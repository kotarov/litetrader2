<?php

if(!isset($_GET['id'])) exit; 

$dbh = new PDO('sqlite:'.DB_DIR.'blog');
$sth = $dbh->prepare("SELECT 
    items.id,
    items.title,
    items.description,
    
    items.id_category,
    
    
    
    items.id_owner,
    
    strftime('%d.%m.%Y',datetime(items.date_add,'unixepoch')) date_add,strftime('%H:%M',datetime(items.date_add,'unixepoch')) date_add_time,
    
    items.tags AS 'tags[]'
    
FROM items items 


WHERE items.id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
