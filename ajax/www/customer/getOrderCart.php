<?php
session_start();
$ret = array();
$get = filter_var_array($_GET,array(
    'id_order'=>FILTER_VALIDATE_INT    
));

if(isset($_SESSION['customer'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    
    $sql = "SELECT 
        op.id_item, 
        op.item,
        op.note,
        op.unit,
        op.qty,
        op.price
    FROM orders_items op 
    LEFT JOIN orders o ON (o.id = op.id_order)
    WHERE op.id_order = ".$get['id_order']." AND o.id_partner = ".$_SESSION['customer']['id'];
    $ret['data'] = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT
        o.id,
        o.payment_method,
        o.delivery_method,
        o.delivery_price,
        o.tax,
        o.tax_price,
        o.price,
        (SELECT SUM(op.qty*op.price) FROM orders_items op WHERE op.id_order = o.id)+o.tax_price+o.delivery_price total
    FROM orders o 
    WHERE o.id = ".$get['id_order']." AND o.id_partner =  ".$_SESSION['customer']['id'];
    $ret['order'] = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    
    $ret['id']=$get['id_order'];
}

return json_encode($ret);