<?php
$ret = array();

$post = filter_var_array($_POST,array(
    'id' => FILTER_VALIDATE_INT,
    'id_status'=>FILTER_VALIDATE_INT
));

if(!$post['id_status']) $ret['error'] = 'Wrong request';
if(!$post['id']) $ret['error'] = 'Wrong request';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    
    // orders
    $sth = $dbh->prepare("UPDATE orders SET id_status = :id_status WHERE id = :id");
    $sth->execute($post);

    $status = array(
        'id_order'=>$post['id'],
        'id_status'=>$post['id_status']
    );
   include "registerStatus.php";
    
    include "getList.php";
    $ret['id'] = $_REQUEST['id'];
    $ret['success'] = 'Status changed';
}
return json_encode($ret);