<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'name'=>FILTER_SANITIZE_STRING,
    'mrp'=>FILTER_SANITIZE_STRING,
    'ein'=>FILTER_SANITIZE_STRING,
    'phone'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_VALIDATE_EMAIL,
    'skype'=>FILTER_SANITIZE_STRING,
    'facebook'=>FILTER_SANITIZE_STRING,
    'twitter'=>FILTER_SANITIZE_STRING,
    'country'=>FILTER_SANITIZE_STRING,
    'city'=>FILTER_SANITIZE_STRING,
    'address'=>FILTER_SANITIZE_STRING
));

if(!$post['name']) $ret['required'][] = 'name';
if(!$post['mrp']) $ret['required'][] = 'mrp';
if(!$post['email']) $ret['required'][] = 'email';

if(!isset($ret['required'])){
    $sets = array();
    foreach(array_keys($post) AS $k=>$v){
        $sets[] = $v.'=:'.$v;
    }
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->prepare("UPDATE companies SET ".implode(",", $sets)." WHERE id = :id");
    $sth->execute($post);
    include 'getCompanies.php';
    $ret['success'] = 'Company id='.$_REQUEST['id'].' changed.';
    $ret['id'] = $post['id'];
}

return json_encode($ret);