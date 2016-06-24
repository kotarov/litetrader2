<?php
include LIB_DIR.'HumanFileSize.php'; 
$get = filter_var_array($_GET,array(
    'n'=>FILTER_SANITIZE_STRING    
));
$ret = array();

if(!$get['n']) $ret['error'] = 'Wrong request';

if(!isset($get['error'])){
    $ret['data'] = array();
    $sliders = parse_ini_file(INI_DIR."www/sliders.ini",true);
    if(isset($sliders[$get['n']]) && isset($sliders[$get['n']]['title']) ){
        $all = count($sliders[$get['n']]['title']);
        foreach($sliders[$get['n']]['title'] AS $id=>$v){
            $ret['data'][]= array(
                    'id'    => $id+1,
                    'src'   => $sliders[$get['n']]['src'][$id],
                    'title' => $sliders[$get['n']]['title'][$id],
                    'alt'   => $sliders[$get['n']]['alt'][$id],
                    'href'  => $sliders[$get['n']]['href'][$id],
                    'text'  => $sliders[$get['n']]['text'][$id],
                    'actions'=>$id+1,
                    'all'   => $all,
                    'size'  => humanfilesize(filesize(INI_DIR.'../www/img/slide/'.$sliders[$get['n']]['src'][$id]))
                );
        }
    }
}

return json_encode($ret);
