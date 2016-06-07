<?php

$where = '';
if(isset($_REQUEST['id'])) $where = " WHERE items.id = ".(int)$_REQUEST['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'products');

$sth = $dbh->prepare("SELECT 
     
    items.is_visible, 
    items.is_advertise,
    items.is_avaible,
    items.id,
    img.id image,
    c.title category,
    c.is_visible cat_is_visible,
    items.title,
    items.description,
    items.owner,
    items.reference,
    unit.abbreviation unit,
    items.qty,
    items.price,
    items.date_avaible date,
    items.id actions,
    img.date_add date_image,
    (SELECT COUNT(id) FROM images WHERE id_item = items.id) nb_images
FROM items items 
LEFT JOIN categories c ON (c.id = items.id_category) 
LEFT JOIN images img ON (items.id = img.id_item AND img.is_cover = 1) 
LEFT JOIN units unit ON (items.id_unit = unit.id)
$where");
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
