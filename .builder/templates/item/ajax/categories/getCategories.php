<?php
$ret = array();

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');


$ret['data'] = $dbh->query("SELECT 
    __CAT_VISIBLE__
    c.id,
    c.depth_html || c.title title,
    __CAT_SUBTITLE__
    c.position,
    c.tags,
    __CAT_IMAGE__
    c.id actions
FROM categories c 
ORDER BY c.list_order
")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['getforselect'])) $ret['data'] = array_merge(array(array('id'=>0,'name'=>'-')),$ret['data']); 

return json_encode($ret);