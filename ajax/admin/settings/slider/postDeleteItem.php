<?php
include LIB_DIR.'Configuration.php';
$post = filter_var_array($_POST,array(
    'id'    => FILTER_VALIDATE_INT,
    'slide'=> FILTER_SANITIZE_STRING
));

if(!$post['id']) $ret['error'] = '1';
if(!$post['slide']) $ret['error']='2';


if(!isset($ret['error'])){
    $sliders = parse_ini_file(INI_DIR."www/sliders.ini",true);
    $post['id'] -= 1;
    if(isset($sliders[$post['slide']]) && isset($sliders[$post['slide']]['title']) && isset($sliders[$post['slide']]['title'][$post['id']]) ){
        unset( $sliders[$post['slide']]['title'][$post['id']] );
        unset( $sliders[$post['slide']]['src'  ][$post['id']] );
        unset( $sliders[$post['slide']]['alt'  ][$post['id']] );
        unset( $sliders[$post['slide']]['href' ][$post['id']] );
        unset( $sliders[$post['slide']]['text' ][$post['id']] );
        
        $ret['slide'] = $post['slide'];
        $ret['action']= 'remove';
        unset($post['slide']);
        file_put_contents(INI_DIR.'www/sliders.ini', arr2ini($sliders));
        $ret['success'] = 'Data saved successfuly';
    
    }else{
        $ret['error'] = 'Error';
    }
}

return json_encode($ret);
