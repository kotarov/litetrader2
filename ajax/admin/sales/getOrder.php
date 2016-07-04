<?php
$ret = array();

$get = filter_var_array($_GET,array(
    'id'=>FILTER_VALIDATE_INT    
));

if(!$get['id']) $ret['error'] = 'Wrong request';

/*
$payments = parse_ini_file(INI_DIR.'www/payment_methods.ini',true);
$select_payment = 'CASE';
foreach($payments AS $key => $val) $select_payment .= " WHEN key_payment_method = '$key' THEN '".$val['title']."' ";
$select_payment .= " END AS payment_method";

$deliveries = parse_ini_file(INI_DIR.'www/delivery_methods.ini',true);
$select_delivery = 'CASE';
foreach($deliveries AS $key => $val) $select_delivery .= " WHEN key_payment_method = '$key' THEN '".$val['title']."' ";
$select_delivery .= " END AS delivery_method";
*/

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    $dbh->query("ATTACH DATABASE '".DB_DIR."customers' AS 'partner_db'");
    
    $sth = $dbh->query("SELECT 
        '1' original,
        o.id,
        o.partner,
        o.company,
        o.ein,
        o.email,
        o.phone,
        o.country,
        o.city,
        o.address,
        o.id_partner id_partner,
        ptp.name||' '||ptp.family text,
        (CASE WHEN (o.id_company = 0 OR o.id_company IS NULL) AND length(o.company) > 0 THEN -1 ELSE o.id_company END) id_company,
        (CASE WHEN o.id_partner > 0 THEN 1 ELSE 0 END) is_registered,
        o.key_payment_method,
        o.key_delivery_method,
        o.key_tax
    FROM orders o 
    LEFT JOIN partner_db.partners ptp ON (ptp.id = o.id_partner) 
    WHERE o.id = ".$get['id']);

    $ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

    $ret['success'] = 'Ok';
}

return json_encode($ret);