<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
));

if(!$post['id']) $ret['error'] = 'Wrong ID ?';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'supplies');
    $sth = $dbh->prepare("DELETE FROM statuses WHERE id = :id");
    if( $sth->execute($post) ){
        $ret['id'] = $post['id'];
        $ret['success'] = 'Status deleted';
    }else {
        $ret['error'] = 'Cannot delete';
    }

}

return json_encode($ret);