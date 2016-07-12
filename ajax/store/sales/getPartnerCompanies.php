<?php

$get = filter_var_array($_GET,array(
    'id_partner'=> FILTER_VALIDATE_INT    
));


$unreg = array(
    array('id'=>-1, 'text'=>'<span class="uk-text-muted">UNREGISTERED</span>','icon'=>'','email'=>'','country'=>'','city'=>'','address'=>'','phone'=>'', 'logo_date'=>''),
    array('id'=>0, 'text'=>'<span class="uk-icon-home"> Home</span>','icon'=>'','email'=>'','country'=>'','city'=>'','address'=>'','phone'=>'', 'logo_date'=>''),
);
$where = '';
$dbh = new PDO('sqlite:'.DB_DIR.'customers');
if($get['id_partner']) {
    $id_companies = $dbh->query("SELECT id_company FROM partners_companies WHERE id_partner=".$get['id_partner'])->fetchAll(PDO::FETCH_COLUMN);
    $where = 'WHERE id IN ('.implode(",",$id_companies).')';
    $home = $dbh->query("SELECT '0' id, ('Home / '||city) text, 'uk-icon-home' icon, email, country, city, address, phone, 'home' logo_date FROM partners WHERE id = ".$get['id_partner'])->fetch(PDO::FETCH_ASSOC);
}

$ret['data'] = $dbh->query("SELECT id, (name || ' / ' || city ) text, 'uk-icon-building' icon, email, country, city, address, phone, ein, logo_date FROM companies $where")->fetchAll(PDO::FETCH_ASSOC);
$ret['data'] = array_merge($unreg, $ret['data']);

return json_encode($ret);