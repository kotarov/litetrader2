<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
));

if(!$post['id']) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$sth = $dbh->prepare("DELETE FROM units WHERE id = :id");
if( $sth->execute($post) ){
    $ret['id'] = $post['id'];
    $ret['success'] = 'Item deleted';
}else {
    $ret['error'] = 'Cannot delete item';
}

return json_encode($ret);