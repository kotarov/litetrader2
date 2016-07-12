<?php
$ret['data'] = parse_ini_file(INI_DIR.'www/payment_methods.ini',true);
foreach($ret['data'] AS $key=>$value){
    $ret['data'][$key]['id'] = $key;
}

return json_encode($ret);