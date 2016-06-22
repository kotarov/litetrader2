<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id_parent'=>FILTER_VALIDATE_INT,
    'id_item'=>FILTER_VALIDATE_INT,
    'note'=>FILTER_SANITIZE_STRING,
    'id_unit'=>FILTER_VALIDATE_INT,
    'price'=>FILTER_VALIDATE_FLOAT,
    'qty'=>FILTER_VALIDATE_FLOAT
));

if(!$post['id_parent']) $ret['required'][] = 'id_parent';
if(!$post['id_item']) $ret['required'][] = 'id_item';
if(!$post['price'] || $post['price'] < 0) $ret['required'][] = 'price';
if(!$post['qty'] || $post['qty'] < 0 ) $ret['required'][] = 'qty';

if(!isset($ret['required'])){
    if(!$post['id_unit']){
        $dbh = new PDO('sqlite:'.DB_DIR.'products');
        $post['id_unit'] = $dbh->query("SELECT id FROM units WHERE is_default = 1")->fetch(PDO::FETCH_COLUMN);
    }
    $post['id_order'] = $post['id_parent']; unset($post['id_parent']);
    $post['is_closed'] = 0;
    $post['date_add'] = time();
    
    $dbh = new PDO('sqlite:'.DB_DIR.'products');
    $post['item'] = $dbh->query("SELECT title FROM items WHERE id = ".$post['id_item'])->fetch(PDO::FETCH_COLUMN);
    $post['unit'] = $dbh->query("SELECT abbreviation FROM units WHERE id = ".$post['id_unit'])->fetch(PDO::FETCH_COLUMN);    

    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    $sets = array_keys($post);

    $sth = $dbh->prepare("INSERT INTO orders_items (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    
    $sth->execute($post);

    $_REQUEST['id'] = $post['id_order'];
    include '../getList.php';
    $ret['success'] = 'Added successful.';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode($ret);