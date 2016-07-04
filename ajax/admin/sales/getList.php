<?php
$where = '';
if(isset($_REQUEST['id'])) $where = " WHERE o.id = ".(int)$_REQUEST['id'];

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
//print_r($select_payment);exit;


$date_format = '%d.%m.%Y';

$dbh = new PDO('sqlite:'.DB_DIR.'sales');
$sth = $dbh->prepare("SELECT 
    s.icon status,
    o.id,
    strftime('$date_format',date(o.date_add,'unixepoch')) date_add,
    o.partner,
    o.id_partner,
    o.id_company,o.company,
    o.city, o.country, o.address,
    (SELECT SUM(oi.price*oi.qty) FROM orders_items oi WHERE oi.id_order = o.id) total, 
    o.invoice,
    o.id actions,
    o.id_partner,
    s.is_closed,
    s.color,
    s.name status_name,
    o.payment_method,
    o.delivery_method,
    o.delivery_price,
    o.tax,
    o.tax_price
FROM orders o 
LEFT JOIN orders_statuses os ON ( os.id_order = o.id ) 
LEFT JOIN statuses s ON ( o.id_status = s.id ) 
$where GROUP BY o.id");

$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);