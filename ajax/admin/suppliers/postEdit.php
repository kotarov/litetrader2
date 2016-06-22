<?php
$ret = array();
if(isset($_POST['birthday'])) $_POST['birthday'] = strtotime( $_POST['birthday'] );
if(isset($_POST['datetime_date']) && isset($_POST['datetime_time'])) $_POST['datetime'] = strtotime( $_POST['datetime_date'].' '.$_POST['datetime_time'] );
if(isset($_POST['somedate'])) $_POST['somedate'] = strtotime( $_POST['somedate'] );


$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
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
    'password'=>FILTER_DEFAULT
));

if(!$post['id']) $ret['required'][] = 'name';
if(!$post['name']) $ret['required'][] = 'name';
if(!$post['email']) $ret['required'][] = 'email';

if(!isset($ret['required'])){
    if(!$post['password']) unset($post['password']);
    else $post['password'] = md5($post['password']);
    
    $sets = array();
    foreach(array_keys($post) AS $k=>$v){
        $sets[] = $v.'=:'.$v;
    }
    $dbh = new PDO('sqlite:'.DB_DIR.'suppliers');

    $sth = $dbh->prepare("UPDATE partners SET ".implode(",", $sets)." WHERE id = :id");
    $sth->execute($post);
    
    //////
    $t = $dbh->query("SELECT id_company FROM partners_companies WHERE id_partner = ".$post['id'])->fetchAll(PDO::FETCH_NUM);
    $old_companies = array(); foreach($t AS $k => $v) $old_companies[] = $v[0];
    $new_companies = (isset($_POST['id_company']) && is_array($_POST['id_company']) ) ? array_values($_POST['id_company']) : array();
    
    $to_delete = array_diff($old_companies, $new_companies);
    if(sizeof($to_delete) > 0){
        $delete = implode(',',$to_delete);
        $dbh->query("DELETE FROM partners_companies WHERE id_company IN ($delete)");
    }
    
    $to_insert = array_diff($new_companies, $old_companies);
    if(sizeof($to_insert)>0){
        $insert = '('.$post['id'].', '. implode("), (".$post['id'].', ', $to_insert).')'; 
        $dbh->query("INSERT INTO partners_companies (id_partner, id_company) VALUES $insert");
    }
    //////
    
    include 'getPartners.php';
    $ret['success'] = 'Partner id='.$_REQUEST['id'].' changed.';
    $ret['id'] = $post['id'];
}

return json_encode($ret);