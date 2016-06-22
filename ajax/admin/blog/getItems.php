<?php

$where = '';
if(isset($_REQUEST['id'])) $where = " WHERE items.id = ".(int)$_REQUEST['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'blog');


$sth = $dbh->prepare("SELECT 
    items.is_active, 
     
    items.is_advertise,
    
    items.id,
    img.id image, img.date_add date_image,(SELECT COUNT(id) FROM images WHERE id_item = items.id) nb_images,
    c.title category, c.is_visible cat_is_visible,
    items.title,
    items.description,
    
    
    
    
    
    items.date_avaible date,
    items.id actions
FROM items items 
LEFT JOIN categories c ON (c.id = items.id_category) 
LEFT JOIN images img ON (items.id = img.id_item AND img.is_cover = 1) 


$where");
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
