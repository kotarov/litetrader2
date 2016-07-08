<?php
include_once LIB_DIR.'Tax.php';
session_start();

$ret = array();
$post = filter_var_array($_POST,array(
    'address'=>FILTER_SANITIZE_STRING,
    'city'=>FILTER_SANITIZE_STRING,
    'partner'=>FILTER_SANITIZE_STRING,
    'phone'=>FILTER_SANITIZE_STRING,
    'delivery_method'=>FILTER_SANITIZE_STRING,
    'payment_method'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_SANITIZE_EMAIL,
    'country'=>FILTER_SANITIZE_STRING
));

if(!$post['address']) $ret['required'][] = 'address';
if(!$post['city']) $ret['required'][] = 'city';
if(!$post['partner']) $ret['required'][]='partner';
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
    $_GET['city'] = $post['city']; $NO_JSON = true;
    $delivery_methods = include __DIR__.'/../getDeliveryMethods.php';
    if(isset($delivery_methods['data']) && isset($delivery_methods['data'][$post['delivery_method']])){
        $delivery = $delivery_methods['data'][$post['delivery_method']];
    }else {
        $delivery  = array('title'=>'-','price'=>0);
    }
    
    $sum = 0; foreach($_SESSION['cart'] AS $n => $r) $sum += $r['qty'] * $r['price']; $sum = number_format($sum,2);
    $tax = calculateDefaultTax($sum);
    
    $_SESSION['order'] = array(
        'id_partner' => isset($_SESSION['customer']['id']) ? $_SESSION['customer']['id'] : null,
        'partner'=>$post['partner'],
        'id_company'=>null,
        'company'=>'',
        'mrp'=>'',
        'ein'=>'',
        'phone'=>$post['phone'],
        'email'=>$post['email'],
        'address'=>$post['address'],
        'city'=>$post['city'],
        'country'=>'България',
        'key_delivery_method'=>$post['delivery_method'],
        'delivery_method'=>$delivery['title'],
        'delivery_price'=>number_format((float)$delivery['price'], 2),
        'price'=> $sum,
        'total'=>number_format(($sum + $delivery['price'] + $tax['value']),2),
        'payment_method'=>$payments[$post['payment_method']]['title'],
        'key_payment_method'=>$post['payment_method'],
        'date_add'=>date("d.m.Y"),
        'key_tax'=>$tax['key'],
        'tax'=>$tax['title'],
        'tax_price'=>$tax['value']
    );
    $ret['order'] = $_SESSION['order'];
    $ret['cart'] = $_SESSION['cart'];
    $ret['success'] = "OK";
}

return json_encode($ret);
?>