<?php
include LIB_DIR.'Configuration.php';
$post = filter_var_array($_POST,array(
    'id'    => FILTER_VALIDATE_INT,
    'title' => FILTER_SANITIZE_STRING,
    'alt'   => FILTER_SANITIZE_STRING,
    'href'  => FILTER_SANITIZE_STRING,
    'text'  => FILTER_SANITIZE_STRING,
    'slider'=> FILTER_SANITIZE_STRING,
    'src'=> FILTER_SANITIZE_STRING,
));

if(!$post['id']) $ret['required'][] = 'id';
if(!$post['alt']) $ret['required'][] = 'alt';
if(!$post['slider']) {$ret['required'][]='slider';$ret['error']='Error';}

if(!isset($ret['required'])){
    $sliders = parse_ini_file(INI_DIR."www/sliders.ini",true);
    
    if(isset($sliders[$post['slider']]) && isset($sliders[$post['slider']]['title'])){
        foreach( $sliders[$post['slider']]['title'] AS $id=>$v){
            
            if($id == ($post['id']-1) ){
                $sliders[$post['slider']]['title'][$id] = $post['title'];
                $sliders[$post['slider']]['alt'][$id] = $post['alt'];
                $sliders[$post['slider']]['href'][$id] = $post['href'];
                $sliders[$post['slider']]['text'][$id] = $post['text'];
                $sliders[$post['slider']]['src'][$id] = $post['src'];
            }
        } 
        
        unset($post['slider']);
        file_put_contents(INI_DIR.'www/sliders.ini', arr2ini($sliders));
        $ret['success'] = 'Data saved successfuly';
    }else{
        $ret['error'] = 'Error';
    }
}

return json_encode($ret);
