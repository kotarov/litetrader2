<?php
$ret['data'] = parse_ini_file(INI_DIR.'www/taxes.ini',true);
foreach($ret['data'] AS $key=>$value){
    $ret['data'][$key]['id'] = $key;
    if($value['value']) $ret['data'][$key]['title'] .= ' ('.$value['value'].')';
}

return json_encode($ret);