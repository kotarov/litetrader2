<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'id_parent' => FILTER_VALIDATE_INT
));

if(!$post['id']) $ret['error'] = 'Wrong ID !';
if(!$post['id_parent']) $ret['error'] = 'Wrong id_parent !';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->prepare("DELETE FROM partners_companies WHERE id_partner = :id AND id_company = :id_parent");
    if( $sth->execute($post) ){
        $_REQUEST['id'] = $post['id_parent'];
        include '../companies/getCompanies.php';
        $ret['id'] = $post['id_parent'];
        $ret['success'] = 'Employee removed';
    }else {
        $ret['error'] = 'Cannot remove';
    }

}

return json_encode($ret);