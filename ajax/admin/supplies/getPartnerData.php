<?php

if(isset($_GET['id_company']) && $_GET['id_company']=='null') $_GET['id_company']=-1;

$get = filter_var_array($_GET,array(
    'id_company'=> FILTER_VALIDATE_INT,
    'id_partner'=> FILTER_VALIDATE_INT,
    'field'     => FILTER_SANITIZE_STRING
));


if(!in_array($get['field'],array('partner','name','email','phone','country','city','address','ein'))) exit;


if( ($get['field'] == "name" && !$get['id_company'])
    || (!$get['id_partner'] && !$get['id_company'])
    || ($get['field'] == 'partner' && !$get['id_partner'])
){
    $ret['data'] = array(array("text"=>""));
}else{
    if($get['field'] == "partner"){ 
        $get['id_company'] = 0;
        $get['field'] = "name||' '||surname||' '||family";
    }
    $dbh = new PDO('sqlite:'.DB_DIR.'suppliers');
    $sth = $dbh->query("SELECT ".$get['field']." text FROM ".($get['id_company']?'companies':'partners')." WHERE id = ".($get['id_company']?$get['id_company']:$get['id_partner']));
    $ret['data'] = $sth->fetch(PDO::FETCH_ASSOC);
}
return json_encode($ret);