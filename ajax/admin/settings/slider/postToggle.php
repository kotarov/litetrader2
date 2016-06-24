<?php
include LIB_DIR.'Configuration.php';
$ret = array();
$get = filter_var_array($_GET,array(
    'pos'=>FILTER_VALIDATE_INT,
    'd'=>FILTER_SANITIZE_STRING,
    'slider'=>FILTER_SANITIZE_STRING
));

if($get['pos'] < 1) $ret['error'] = '1';
if(!in_array($get['d'],array('up','down'))) $ret['error'] = '2';
if(!$get['slider']) $ret['error'] = '3';

if(!isset($get['error'])){
    $get['pos'] -=1;
    $sliders = parse_ini_file(INI_DIR."www/sliders.ini",true);
    if(isset($sliders[$get['slider']]) && isset($sliders[$get['slider']]['title'])){
        $new_pos = ($get['d'] == 'up' ? $get['pos']-1 : $get['pos'] + 1);
        
        if(isset($sliders[$get['slider']]['title'][$get['pos']])  && isset($sliders[$get['slider']]['title'][$new_pos])){
            $temp['src'  ]  = $sliders[$get['slider']]['src'  ][$get['pos']];
            $temp['title']  = $sliders[$get['slider']]['title'][$get['pos']];
            $temp['alt'  ]  = $sliders[$get['slider']]['alt'  ][$get['pos']];
            $temp['href' ]  = $sliders[$get['slider']]['href' ][$get['pos']];
            $temp['text' ]  = $sliders[$get['slider']]['text' ][$get['pos']];
            
            $sliders[$get['slider']]['src'  ][$get['pos']] = $sliders[$get['slider']]['src'  ][$new_pos];
            $sliders[$get['slider']]['title'][$get['pos']] = $sliders[$get['slider']]['title'][$new_pos];
            $sliders[$get['slider']]['alt'  ][$get['pos']] = $sliders[$get['slider']]['alt'  ][$new_pos];
            $sliders[$get['slider']]['href' ][$get['pos']] = $sliders[$get['slider']]['href' ][$new_pos];
            $sliders[$get['slider']]['text' ][$get['pos']] = $sliders[$get['slider']]['text' ][$new_pos];
            
            $sliders[$get['slider']]['src'  ][$new_pos] = $temp['src'  ];
            $sliders[$get['slider']]['title'][$new_pos] = $temp['title'];
            $sliders[$get['slider']]['alt'  ][$new_pos] = $temp['alt'  ];
            $sliders[$get['slider']]['href' ][$new_pos] = $temp['href' ];
            $sliders[$get['slider']]['text' ][$new_pos] = $temp['text' ];
        
            unset($get['slider']);
            file_put_contents(INI_DIR.'www/sliders.ini', arr2ini($sliders));
            $ret['success'] = 'Ok';
        }else{ $ret['error'] = 'Not exists';}
    }else{
        $ret['error'] = 'Error';
    }
}

return json_encode($ret);