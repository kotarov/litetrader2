<?php

if(!isset($_GET['id'])) exit; 

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$sth = $dbh->prepare("SELECT 
    items.id,
    items.title,
    __DESCRIPTION__
    __REFERENCE__
    __ID_CATEGORY__
    __ID_UNIT__
    __PRICE__
    __QTY__
    __ID_OWNER__
    __ID_OWNER_COMPANY__
    __FORM_DATE_ADD__
    
    items.tags AS 'tags[]'
    
FROM items items 


WHERE items.id = ".(int)$_GET['id']);
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
