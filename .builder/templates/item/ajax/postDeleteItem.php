<?php

$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
));

if(!$post['id']) $ret['error'] = 'Wrong ID ?';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->prepare("DELETE FROM items WHERE id = :id");
    if( $sth->execute($post) ){
        $sth = $dbh->prepare("DELETE FROM images WHERE id_item = ".$post['id']);
        $sth->execute();
        
        $ret['data'] = array( $post['id'] );
        $ret['success'] = 'Item deleted';
        $ret['id'] = $post['id'];
    }else {
        $ret['error'] = 'Cannot delete item';
    }

}

return json_encode($ret);