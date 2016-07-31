<?php

$where = 'WHERE 1';
if(isset($_REQUEST['id'])) $where .= " AND items.id = ".(int)$_REQUEST['id'];
 
//if( isset($_SESSION['admin']['access']['suppliers_companies']) ) $where .= " AND items.id_owner_company IN (".implode(',',array_keys($_SESSION['admin']['access']['suppliers_companies'])).")";
if( isset($_SESSION['admin']['access']['suppliers_persons']) ) $where .= " AND items.id_owner IN (".implode(',',array_keys($_SESSION['admin']['access']['suppliers_persons'])).")";
//if( isset($_SESSION['admin']['access']['suppliers_persons']) ) $where .= " AND items.id_owner IN (".implode(',',array_keys($_SESSION['admin']['access']['suppliers_persons'])).")";


$dbh = new PDO('sqlite:'.DB_DIR.'blog');
$dbh->query("ATTACH DATABASE '".DB_DIR."suppliers' as 'db_suppliers';");

$sth = $dbh->prepare("SELECT 
    items.is_active, 
     
    items.is_advertise,
    
    items.id,
    strftime('%d.%m.%Y %H:%M',datetime(items.date_add,'unixepoch')) date_add,
    img.id image, img.date_add date_image,(SELECT COUNT(id) FROM images WHERE id_item = items.id) nb_images,
    c.title category, c.is_visible cat_is_visible,
    items.title,
    items.description,
    owner.name||' '||owner.family owner,
    
    
    
    
    
    items.date_avaible date,
    items.id actions
FROM items items 
LEFT JOIN categories c ON (c.id = items.id_category) 
LEFT JOIN images img ON (items.id = img.id_item AND img.is_cover = 1) 

LEFT JOIN db_suppliers.partners owner ON (items.id_owner = owner.id) 

$where");
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
