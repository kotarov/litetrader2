<?php
$ret['data'] = parse_ini_file(INI_DIR.'www/delivery_methods.ini',true);
foreach($ret['data'] AS $key=>$value){
    $ret['data'][$key]['id'] = $key;
    if(isset($value['price']) && $value['price']) $ret['data'][$key]['title'] .= ' ('.number_format($value['price'],2).' лв)';
}

return json_encode($ret);