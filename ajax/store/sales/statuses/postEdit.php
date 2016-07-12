<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'icon'=>FILTER_SANITIZE_STRING,
    'color'=>FILTER_SANITIZE_STRING,
    'name'=>FILTER_SANITIZE_STRING,
    'is_closed'=>FILTER_VALIDATE_BOOLEAN
));

if(!$post['id']) $ret['required'][] = 'name';
if(!$post['name']) $ret['required'][] = 'name';
if(!$post['icon']) $ret['required'][] = 'icon';

if(!isset($ret['required'])){
    $sets = array(); foreach(array_keys($post) AS $k=>$v){ $sets[] = $v.'=:'.$v; }
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');

    $sth = $dbh->prepare("UPDATE statuses SET ".implode(",", $sets)." WHERE id = :id");
    $sth->execute($post);
    
    include 'getList.php';
    $ret['success'] = 'Status id='.$_REQUEST['id'].' changed.';
    $ret['id'] = $post['id'];
}

return json_encode($ret);