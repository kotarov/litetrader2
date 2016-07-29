<?php
$ret = array();
$post = filter_var_array($_POST,array(
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
    $sets = array_keys($post);
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->prepare("INSERT INTO companies (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    $sth->execute($post);
    $_REQUEST['id'] = $dbh->lastInsertId();
    
    if(isset($NO_RETURN)) return;
    
    include 'getCompanies.php';
    $ret['success'] = 'Company id='.$_REQUEST['id'].' added successful.';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode($ret);