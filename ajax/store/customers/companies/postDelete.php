<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_SANITIZE_INT,
));

if(!$post['id']) $ret['error'] = 'Wrong ID ?';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    $sth = $dbh->prepare("DELETE FROM companies WHERE id = :id");
    if( $sth->execute($post) ){
        $sth = $dbh->query("DELETE FROM partners_companies WHERE id_company = ".$post['id']);
        $ret['id'] = $post['id'];
        $ret['success'] = 'Company deleted';
    }else {
        $ret['error'] = 'Cannot delete';
    }

}

return json_encode($ret);