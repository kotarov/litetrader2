<?php
include LIB_DIR.'Configuration.php';
$ret = array();

$post = filter_var_array($_POST,array(
    'home'=>FILTER_VALIDATE_BOOLEAN,
    'home_title'=>FILTER_SANITIZE_STRING,
    
    'products'=>FILTER_VALIDATE_BOOLEAN,
    'products_title'=>FILTER_SANITIZE_STRING,
    
    'articles'=>FILTER_VALIDATE_BOOLEAN,
    'articles_title'=>FILTER_SANITIZE_STRING,
    
    'contacts'=>FILTER_VALIDATE_BOOLEAN,
    'contacts_title'=>FILTER_SANITIZE_STRING,
    
    'order'=>FILTER_VALIDATE_BOOLEAN,
    'order_title'=>FILTER_SANITIZE_STRING,
    
    'login_title'=>FILTER_SANITIZE_STRING,
));

$bool_fields = array('home','products','articles','contacts','order');
foreach($bool_fields AS $f){
    $post[$f] = isset($_POST[$f])?"1":"0";
}

file_put_contents(INI_DIR.'www/menus.ini', arr2ini( array('public'=>$post)  ));
$ret['success'] = 'Data saved successfuly';


return json_encode($ret);