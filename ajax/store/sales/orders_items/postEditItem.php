<?php
include_once LIB_DIR.'Tax.php';

$ret = array();
$post = filter_var_array($_POST,array(
    'id'=> FILTER_VALIDATE_INT,
    'id_parent'=> FILTER_VALIDATE_INT,
    'id_item'=>FILTER_VALIDATE_INT,
    'id_unit'=>FILTER_VALIDATE_INT,
    'note'=>FILTER_SANITIZE_STRING,
    'price'=>FILTER_VALIDATE_FLOAT,
    'qty'=>FILTER_VALIDATE_FLOAT
));

if(!$post['id']) $ret['required'][] = die();
if(!$post['id_parent']) die();

if(!$post['price'] || $post['price'] < 0) $ret['required'][] = 'price';
if(!$post['qty'] || $post['qty'] < 0 ) $ret['required'][] = 'qty';

if(!isset($ret['required'])){
    $post['id_order'] = $post['id_parent']; unset($post['id_parent']);

    $dbh = new PDO('sqlite:'.DB_DIR.'products');
    //$post['item'] = $dbh->query("SELECT title FROM items WHERE id = ".$post['id_item'])->fetch(PDO::FETCH_COLUMN);
    $post['unit'] = $dbh->query("SELECT abbreviation FROM units WHERE id = ".$post['id_unit'])->fetch(PDO::FETCH_COLUMN);  

    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    $sets = array(); foreach(array_keys($post) AS $k=>$v){ $sets[] = $v.'=:'.$v; }

    $sth = $dbh->prepare("UPDATE orders_items SET ".implode(",", $sets)." WHERE id=:id AND id_order = :id_order AND id_item = :id_item");
    $sth->execute($post);

    // update Tax
    $tax = calculateTax($post['id_order'], 'sales', 'www');
    $sth = $dbh->query("UPDATE orders SET tax = '".$tax['title']."', tax_price=".$tax['price']." WHERE id = ".$post['id_order']);
    
    $_REQUEST['id'] = $post['id_order'];
    include '../getList.php';
    $ret['success'] = 'Changed successful.';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode($ret);