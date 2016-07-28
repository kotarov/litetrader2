<?php

$where = '';
if(isset($_REQUEST['id'])) $where = " WHERE items.id = ".(int)$_REQUEST['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'products');
$dbh->query("ATTACH DATABASE '".DB_DIR."suppliers' as 'db_suppliers';");

$sth = $dbh->prepare("SELECT 
     
    items.is_visible, 
    items.is_advertise,
    items.is_avaible,
    items.id,
    strftime('%d.%m.%Y %H:%M',datetime(items.date_add,'unixepoch')) date_add,
    img.id image, img.date_add date_image,(SELECT COUNT(id) FROM images WHERE id_item = items.id) nb_images,
    c.title category, c.is_visible cat_is_visible,
    items.title,
    items.description,
    
    owner_company.name owner_company,
    items.reference,
    unit.abbreviation unit,
    items.qty,
    items.price,
    items.date_avaible date,
    items.id actions
FROM items items 
LEFT JOIN categories c ON (c.id = items.id_category) 
LEFT JOIN images img ON (items.id = img.id_item AND img.is_cover = 1) 
LEFT JOIN units unit ON (items.id_unit = unit.id)

LEFT JOIN db_suppliers.companies owner_company ON (owner_company.id = items.id_owner_company) 
$where");
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
