<?php
include LIB_DIR.'Configuration.php';
$post = filter_var_array($_POST,array(
    'title' => FILTER_SANITIZE_STRING,
    'alt'   => FILTER_SANITIZE_STRING,
    'href'  => FILTER_SANITIZE_STRING,
    'text'  => FILTER_SANITIZE_STRING,
    'slider'=> FILTER_SANITIZE_STRING,
    'src'=> FILTER_SANITIZE_STRING,
));

if(!$post['alt']) $ret['required'][] = 'alt';
if(!$post['slider']) {$ret['required'][]='slider';$ret['error']='Error1';}

if(!isset($ret['required'])){
    $sliders = parse_ini_file(INI_DIR."www/sliders.ini",true);
    
    if(isset($sliders[$post['slider']])){
        if(!isset($sliders[$post['slider']]['title'])) 
            $n=0; 
        else 
            $n = count($sliders[$post['slider']]['title']);
        
        $sliders[$post['slider']]['title'][$n] = $post['title'];
        $sliders[$post['slider']]['alt'  ][$n] = $post['alt'];
        $sliders[$post['slider']]['href' ][$n] = $post['href'];
        $sliders[$post['slider']]['text' ][$n] = $post['text'];
        $sliders[$post['slider']]['src'  ][$n] = $post['src'];
        
        $ret['slide'] = $post['slider'];
        $ret['action'] = 'add';
        unset($post['slider']);
        file_put_contents(INI_DIR.'www/sliders.ini', arr2ini($sliders));
        $ret['success'] = 'Data saved successfuly';
        
    }else{
        $ret['error'] = 'Slider not found';
    }
}

return json_encode($ret);
