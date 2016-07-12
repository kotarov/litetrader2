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
    'phone'=>FILTER_SANITIZE_STRING,
    'work'=>FILTER_SANITIZE_STRING, 'mobile'=>FILTER_SANITIZE_STRING, 'sip'=>FILTER_SANITIZE_STRING,
    'skype'=>FILTER_SANITIZE_STRING, 'facebook'=>FILTER_SANITIZE_STRING, 'twitter'=>FILTER_SANITIZE_STRING,
    'country'=>FILTER_SANITIZE_STRING, 'city'=>FILTER_SANITIZE_STRING, 'address'=>FILTER_SANITIZE_STRING,
    'site'=>FILTER_SANITIZE_STRING,
    'birthday'=>FILTER_VALIDATE_INT,
    'datetime'=>FILTER_VALIDATE_INT,
    'somedate'=>FILTER_VALIDATE_INT,
));

if(!$post['name']) $ret['required'][] = 'name';
if(!$post['email']) $ret['required'][] = 'email';

if(!isset($ret['required'])){
    $post['date_add'] = time();
    $sets = array_keys($post);
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    $sth = $dbh->prepare("INSERT INTO partners (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    $sth->execute($post);
    $_REQUEST['id'] = $dbh->lastInsertId();
    
    if(isset($_POST['id_company']) && is_array($_POST['id_company']) ){
        $insert = '('.$_REQUEST['id'].', '. implode("), (".$_REQUEST['id'].', ', array_values($_POST['id_company'])).')'; 
        $dbh->query("INSERT INTO partners_companies (id_partner, id_company) VALUES $insert");
    }

    
    if(isset($NO_RETURN)) return;
    
    include 'getPartners.php';
    $ret['success'] = 'Record id='.$_REQUEST['id'].' added successful.';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode($ret);