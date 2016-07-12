<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
));

if(!$post['id']) $ret['error'] = 'Wrong ID ?';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    $sth = $dbh->prepare("DELETE FROM partners WHERE id = :id");
    if( $sth->execute($post) ){
        $sth = $dbh->query("DELETE FROM partners_companies WHERE id_partner = ".$post['id']);
        $ret['id'] = $post['id'];
        $ret['success'] = 'Successfully deleted !';
    }else {
        $ret['error'] = 'Cannot delete';
    }

}

return json_encode($ret);