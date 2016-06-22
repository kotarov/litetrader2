<?php
$ret = array();

$dbh = new PDO('sqlite:'.DB_DIR.'products');


$ret['data'] = $dbh->query("SELECT 
    c.is_visible,
    c.id,
    c.depth_html || c.title title,
    c.subtitle,
    c.position,
    c.tags,
    c.id image,c.date_image, c.image_size,
    c.id actions
FROM categories c 
ORDER BY c.list_order
")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['getforselect'])) $ret['data'] = array_merge(array(array('id'=>0,'name'=>'-')),$ret['data']); 

return json_encode($ret);