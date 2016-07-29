<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'field'=>FILTER_SANITIZE_STRING
));

if(!$post['id']) $ret['error'] = 'Wrong ID !';
if(!in_array($post['field'], array('is_visible') )) $ret['error']='Wrong request!';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    
    $value = $dbh->query("SELECT ".$post['field']." FROM categories WHERE id = ".$post['id'])->fetch(PDO::FETCH_COLUMN);
    $sth = $dbh->prepare("UPDATE categories SET ".$post['field']." = ".($value?'null':1)." WHERE id = ".$post['id']);
    if( $sth->execute() ){
         $_GET['getforselect'] = 1;
        include 'getCategories.php';
        $ret['success'] = 'Success';
    } else {
        $ret['error'] = 'Cannot set this value';
    }
}

return json_encode($ret);