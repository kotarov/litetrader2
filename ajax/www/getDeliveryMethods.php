<?php
$ret = array();

$get = filter_var_array($_GET,array(
    'city' => FILTER_SANITIZE_STRING    
));

if($get['city']){
    $methods = parse_ini_file(INI_DIR.'www/delivery_methods.ini',true);
    foreach($methods AS $key=>$method){
        if(isset($method['city'][$get['city']] )){
            $ret['data'][$key] = array('title'=>$method['title'], 'price'=>$method['city'][$get['city']]); 
        }elseif(isset($method['price'])){
            $ret['data'][$key] = array('title'=>$method['title'], 'price'=>$method['price']);
        }    
    }
}

return json_encode($ret); 