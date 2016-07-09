<?php
/// strftime('%d - %m  - %Y ', datetime(o.date_add, 'unixepoch'))

session_start();
$ret = array();
$get = filter_var_array($_GET,array(
    't'=>FILTER_SANITIZE_STRING    
));


if(isset($_SESSION['customer'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    $where = 1;
    if($get['t'] == 'active' ) $where = "s.is_closed != 1 OR s.is_closed IS NULL"; 
    if($get['t'] == 'done' ) $where = "s.is_closed == 1";
    if($get['t'] == 'canceled' ) $where = "0"; 

    $sql = "SELECT 
            strftime('%d.%m.%Y',datetime(o.date_add,'unixepoch')) date,
            o.country||', '||o.city||', '||o.address address, 
            (SELECT COUNT(id) FROM orders_items WHERE id_order = o.id) products, 
            (SELECT SUM(op.qty*op.price) FROM orders_items op WHERE op.id_order = o.id)+o.tax_price+o.delivery_price total,
            o.id id,
            o.partner,
            o.phone,
            o.email,
            o.payment_method,
            o.delivery_method,
            o.delivery_price,
            o.tax,
            o.tax_price
        FROM orders o 
        LEFT JOIN statuses s ON (s.id = o.id_status)
        WHERE $where AND o.id_partner = ".$_SESSION['customer']['id']."
        ORDER BY o.date_add DESC"; 
    
    $ret['data'] = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

return json_encode($ret);