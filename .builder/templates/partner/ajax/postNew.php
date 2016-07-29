<?php
$ret = array();
if(isset($_POST['birthday'])) $_POST['birthday'] = strtotime( $_POST['birthday'] );
if(isset($_POST['datetime_date']) && isset($_POST['datetime_time'])) $_POST['datetime'] = strtotime( $_POST['datetime_date'].' '.$_POST['datetime_time'] );
if(isset($_POST['somedate'])) $_POST['somedate'] = strtotime( $_POST['somedate'] );

$post = filter_var_array($_POST,array(
    'name'=>FILTER_SANITIZE_STRING,
    'surname'=>FILTER_SANITIZE_STRING,
    'family'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_VALIDATE_EMAIL,
    __FILTER_PHONE__
    __FILTER_OTHER_PHONES__
    __FILTER_SOCIALS__
    __FILTER_ADDRESS__
    __FILTER_SITE__
    __FILTER_BIRTHDAY__
    __FILTER_DATETIME__
    __FILTER_SOMEDATE__
));

if(!$post['name']) $ret['required'][] = 'name';
if(!$post['email']) $ret['required'][] = 'email';

if(!isset($ret['required'])){
    $post['date_add'] = time();
    $sets = array_keys($post);
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->prepare("INSERT INTO partners (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    $sth->execute($post);
    $_REQUEST['id'] = $dbh->lastInsertId();
    
    __INSERT_COMPANIES_ON_POST_NEW__
    
    if(isset($NO_RETURN)) return;
    
    include 'getPartners.php';
    $ret['success'] = 'Record id='.$_REQUEST['id'].' added successful.';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode($ret);