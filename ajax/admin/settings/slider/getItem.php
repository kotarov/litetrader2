<?php
$get = filter_var_array($_GET,array(
    'id'=>FILTER_VALIDATE_INT,
    'slide'=>FILTER_SANITIZE_STRING    
));
$ret = array();

if(!$get['id']) $ret['error'] = 'Wrong request';
if(!$get['slide']) $ret['error'] = 'Wrong request';

if(!isset($get['error'])){
    $ret['data'] = array();
    $get['id'] = $get['id'] - 1;
    $sliders = parse_ini_file(INI_DIR."www/sliders.ini",true);
    if(isset($sliders[$get['slide']])){
        foreach($sliders[$get['slide']]['title'] AS $id=>$v){
            if(($id) == $get['id'])
            $ret['data'][]= array(
                    'id'    => $id+1,
                    'src'   => $sliders[$get['slide']]['src'][$id],
                    'title' => $sliders[$get['slide']]['title'][$id],
                    'alt'   => $sliders[$get['slide']]['alt'][$id],
                    'href'  => $sliders[$get['slide']]['href'][$id],
                    'text'  => $sliders[$get['slide']]['text'][$id],
                    'slider'=> $get['slide']
                );
        }
    }
}

return json_encode($ret);
