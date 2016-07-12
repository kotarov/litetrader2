<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'id_employee'=>FILTER_VALIDATE_INT
));

if(!$post['id']) $ret['error'] = 'Wrong company';
if(!$post['id_employee']) $ret['error'] = 'Wrong employee';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');

    $exists = $dbh->query("SELECT id_company FROM partners_companies WHERE id_company = ".$post['id']." AND id_partner = ".$post['id_employee'])->fetch(PDO::FETCH_COLUMN); 
    if(!$exists){
        $dbh->query("INSERT INTO partners_companies (id_partner, id_company) VALUES (".$post['id_employee'].", ".$post['id'].")");
        $ret['success'] = "Ok";
    }else{
        $ret['success'] = 'Already existed';
    }
    
    $_REQUEST['id'] = $post['id'];
    include '../companies/getCompanies.php';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode( $ret );