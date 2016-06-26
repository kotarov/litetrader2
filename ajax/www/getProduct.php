<?php

$ret = array();
$get = filter_var_array($_GET,array(
    'id'=>FILTER_VALIDATE_INT    
));

if($get['id']){
    $dbh = new PDO('sqlite:'.DB_DIR.'products');
    
    $ret['data'] = $dbh->query("
    SELECT 
        i.id id_image, 
        p.id, 
        p.title, 
        p.reference, 
        p.description, 
        p.tags, 
        round(p.price,2) price, 
        i.date_add, 
        c.url_rewrite url_rewrite, 
        c.title category, 
        c.parents,
        p.content,
        p.is_avaible
    FROM items p 
    LEFT JOIN images i ON (i.id_item = p.id AND i.is_cover =1 )
    LEFT JOIN categories c ON (c.id = p.id_category) 
    WHERE p.id = ".(int)$get['id']." AND p.is_visible = 1"
    )->fetch(PDO::FETCH_ASSOC);
    
    
    //$parents = $dbh->query("SELECT parents FROM categories WHERE id = ".$get['id'])->fetch(PDO::FETCH_COLUMN);
    
    $ret['parents'] = $dbh->query("SELECT id, title, url_rewrite FROM categories WHERE id IN (".$ret['data']['parents'].")
        ORDER BY id=".(implode(" DESC , id=",explode(",",$ret['data']['parents'])))." DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
    
    $ret['images'] = $dbh->query("SELECT i.id,i.date_add FROM images i WHERE i.id_item = ".(int)$get['id'])->fetchAll(PDO::FETCH_ASSOC);
}

return json_encode($ret);
?>