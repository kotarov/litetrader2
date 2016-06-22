<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'icon'=>FILTER_SANITIZE_STRING,
    'name'=>FILTER_SANITIZE_STRING,
    'color'=>FILTER_SANITIZE_STRING,
    'is_closed'=>FILTER_VALIDATE_BOOLEAN
));


if(!$post['name']) $ret['required'][] = 'name';
if(!$post['icon']) $ret['required'][] = 'icon';

if(!isset($ret['required'])){
    $post['is_default'] = 0;
    $sets = array_keys($post);
    $dbh = new PDO('sqlite:'.DB_DIR.'supplies');
    $sth = $dbh->prepare("INSERT INTO statuses (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    $sth->execute($post);
    $_REQUEST['id'] = $dbh->lastInsertId();
    
    include 'getList.php';
    $ret['success'] = 'Status id='.$_REQUEST['id'].' added successful.';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode($ret);