<?php
if(!isset($_SESSION['admin']['id'])) return;

$ret = array('success'=>1);
$post = filter_var_array($_POST,array(
    'name'=>FILTER_SANITIZE_STRING,
    'family'=>FILTER_SANITIZE_STRING,
    'phone'=>FILTER_SANITIZE_STRING,
    'address'=>FILTER_SANITIZE_STRING,
    'password'=>FILTER_DEFAULT
), false);

if(isset($post['password']) && !$post['password']) unset($post['password']);

if($post){
    if(isset($post['password'])) $post['password'] = md5($post['password']);
    
    $sets = array();
    foreach($post AS $k => $v){
        $sets[] = $k.' = :'.$k;
    }
    $dbh = new PDO('sqlite:'.DB_DIR.'employees');
    $sth = $dbh->prepare("UPDATE employees SET ".implode(', ',$sets)." WHERE id = ".$_SESSION['admin']['id']);
    $sth->execute($post);
    
    $_SESSION['admin'] = array_merge( $_SESSION['admin'], $post );
    $ret['success'] = 'Profile updated';
}

return json_encode($ret);