<?php 
$ret['results'] = array();
$post = filter_var_array($_POST,array(
    'search'=>FILTER_SANITIZE_STRING ,
    'id_category'=>FILTER_VALIDATE_INT
));

$post['search'] = trim(rawurldecode($post['search']));
if(!$post['search']) $post['search'] = '~';

$dbh = new PDO('sqlite:'.DB_DIR.'products');
$sth = $dbh->prepare("
SELECT 
    p.id, 
    p.title,
    '".URL_BASE."products/view/index.php/'||p.url_rewrite||'/' AS url,
    p.price,
    p.is_avaible,
    p.description text,
    '/'||p.url_rewrite||'/' AS ukr_rewrite,
    i.id id_image,
    i.date_add,
    c.title category_title 
FROM items p 
LEFT JOIN categories c ON (c.id = p.id_category) 
LEFT JOIN images i ON (i.id_item = p.id AND i.is_cover = 1)  
WHERE (p.is_visible = 1) AND ".($post['id_category'] ?"(p.id_category=".$post['id_category']." OR c.parents LIKE '%,".$post['id_category'].",%') AND ":'')."(
    p.title LIKE '%".$post['search']."%' 
    OR p.reference LIKE '%".$post['search']."%'
    OR p.description LIKE '%".$post['search']."%'
    OR p.tags LIKE '%".$post['search']."%'
    OR c.subtitle LIKE '%".$post['search']."%'
) LIMIT 10");



$sth->execute();
$ret['results'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);