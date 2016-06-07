<?php
if(isset($_POST['price']) && strpos($_POST['price'], '.') === FALSE){
    $_POST['price'] = str_replace(',', '.', $_POST['price']);
}

$ret = array();
$post = filter_var_array($_POST,array(
    'title'=>FILTER_SANITIZE_STRING,
    'reference'=>FILTER_SANITIZE_STRING,
    'price'=>array(
        'filter'=>FILTER_SANITIZE_NUMBER_FLOAT,
        'flags'=>FILTER_FLAG_ALLOW_FRACTION
    ),
    'qty'=>array(
        'filter'=>FILTER_SANITIZE_NUMBER_FLOAT,
        'flags'=>FILTER_FLAG_ALLOW_FRACTION
    ),
    'id_unit'=>FILTER_VALIDATE_INT,
    'id_category'=>FILTER_VALIDATE_INT,
    'id_owner'=>FILTER_VALIDATE_INT,
    'description'=>FILTER_SANITIZE_STRING,
    'tags' => array(
        'filter' => FILTER_SANITIZE_STRING,
        'flags'  => FILTER_FORCE_ARRAY,
    )
));

if(!$post['title']) $ret['required'][] = 'title';
if(!$post['price']) $ret['required'][] = 'price';
//if(!$post['id_supplier']) $ret['required'][] = 'id_supplier';
if(!$post['description']) $ret['required'][] = 'description';
if(!$post['tags']) $ret['required'][] = 'tags[]';

if(!isset($ret['required'])){
    $post['tags'] = implode(',',$post['tags']);
    $post['date_add'] = time();
    
    $sets = array_keys($post);
    $dbh = new PDO('sqlite:'.DB_DIR.'products');
    $sth = $dbh->prepare("INSERT INTO items (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    $sth->execute($post);
    $_REQUEST['id'] = $dbh->lastInsertId();
    $url_rewrite = $_REQUEST['id']."-".str_replace(array(" "),"-",$post['title']);
    $dbh->query("UPDATE items SET url_rewrite='".$url_rewrite."' WHERE id = ".$_REQUEST['id']);
    include 'getItems.php';
    $ret['success'] = 'Item id='.$_REQUEST['id'].' added successful.';
}

return json_encode($ret);
