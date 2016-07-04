<?php
session_start();

$ret = array();
$post = filter_var_array($_POST,array(
    'address'=>FILTER_SANITIZE_STRING,
    'city'=>FILTER_SANITIZE_STRING,
    'customer'=>FILTER_SANITIZE_STRING,
    'phone'=>FILTER_SANITIZE_STRING,
    'delivery_method'=>FILTER_SANITIZE_STRING,
    'payment_method'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_SANITIZE_EMAIL
));

if(!$post['address']) $ret['required'][] = 'address';
if(!$post['city']) $ret['required'][] = 'city';
if(!$post['customer']) $ret['required'][]='customer';
if(!$post['phone']) $ret['required'][] = 'phone';
if(!$post['email']) $ret['required'][] = 'email';
if(!$post['delivery_method']) $ret['required'][] = 'delivery-method';
if(!$post['payment_method']) $ret['required'][] = 'payment-method';
if(!isset($_SESSION['cart']) || !count($_SESSION['cart'])) $ret['required'][] = 'cart-container';

$deliveries = parse_ini_file(INI_DIR.'www/delivery_methods.ini',true);
if(!isset($deliveries[$post['delivery_method']]) ) $ret['required'][] = 'delivery-method';

$payments = parse_ini_file(INI_DIR.'www/payment_methods.ini',true);
if(!isset($payments[$post['payment_method']]) ) $ret['required'][] = 'payment-method';

if(!isset($ret['required'])){
    
    $sum = 0; foreach($_SESSION['cart'] AS $n => $r) $sum += $r['qty'] * $r['price']; $sum = number_format($sum,2);
    $_SESSION['order'] = array(
        'customer'=>$post['customer'],
        'phone'=>$post['phone'],
        'email'=>$post['email'],
        'address'=>$post['city'].'; '.$post['address'],
        'delivery_method'=>$post['delivery_method'],
        'delivery_title'=>$deliveries[$post['delivery_method']]['title'],
        'delivery_price'=>number_format($deliveries[$post['delivery_method']]['price'], 2),
        'sum'=> $sum,
        'total'=>number_format(($sum + $deliveries[$post['delivery_method']]['price']),2),
        'payment_method'=>$payments[$post['payment_method']]['title'],
        
    );
    $ret['order'] = $_SESSION['order'];
    $ret['cart'] = $_SESSION['cart'];
    $ret['success'] = "OK";
}

return json_encode($ret);
?>