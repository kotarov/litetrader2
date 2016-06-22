<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'content_script'=>FILTER_DEFAULT,
    'content'=>FILTER_DEFAULT
));


if(!$post['id']) $ret['errors'] = 'Wrong id';

if(!isset($ret['errors'])){
    if($post['content_script']) $post['content'] =$post['content_script'];
    unset($post['content_script']);
    
    $dbh = new PDO('sqlite:'.DB_DIR.'blog');  
    $sth = $dbh->prepare("UPDATE items SET content = :content WHERE id = :id");
    $sth->execute($post);
    include 'getItems.php';
    $ret['id'] = $post['id'];
    $ret['success'] = 'Item #'.$_REQUEST['id'].' content changed.';
}
return json_encode($ret);