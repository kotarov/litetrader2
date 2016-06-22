<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'        => FILTER_VALIDATE_INT,
    'id_parent' => FILTER_VALIDATE_INT,
    'id_item'   => FILTER_VALIDATE_INT
));

if(!$post['id'] || !$post['id_parent'] || !$post['id_item']) $ret['error'] = 'Wrong Request !';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'supplies');
    $sth = $dbh->prepare("DELETE FROM orders_items WHERE id=:id AND id_order = :id_parent AND id_item = :id_item");
    if( $sth->execute($post) ){
        $_REQUEST['id'] = $post['id_parent'];
        include '../getList.php';
        $ret['success'] = 'Removed successful.';
        $ret['id'] = $_REQUEST['id'];
    }else {
        $ret['error'] = 'Cannot remove';
    }

}

return json_encode($ret);