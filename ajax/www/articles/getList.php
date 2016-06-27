<?php

$id= isset($_GET['id'])?(int)$_GET['id']:0;

$ret = array();
$dbh = new PDO('sqlite:'.DB_DIR.'blog');
$ret['data'] = $dbh->query("
    SELECT 
        b.id,
        b.title,
        b.description,
        c.title category,
        b.tags,
        b.owner,
        strftime('%d.%m.%Y %H:%M',datetime(b.date_add,'unixepoch')) date_add,
        b.content,
        im.id id_image,
        im.date_add image_date,
        c.url_rewrite cat_url_rewrite,
        b.url_rewrite
    FROM items b
    LEFT JOIN categories c ON (c.id = b.id_category)
    LEFT JOIN images im ON (im.id_item = b.id AND im.is_cover = 1) 
    WHERE b.is_active = 1 AND c.is_visible = 1 ".($id?'AND b.id_category='.$id:'')."  
    ORDER BY b.date_add DESC 
")->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);