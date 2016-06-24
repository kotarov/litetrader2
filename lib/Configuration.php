<?php
function arr2ini($arr,$depth=1){
    $content = '';
    foreach($arr AS $key => $vals){
        
        if(!is_array($vals)){
            $content .= $key .' = "'.$vals.'"'."\n";
        }elseif($depth == 1){
            $content .= "[$key]\n";
            $content .= arr2ini($vals,$depth+1)."\n";
        }else{
            
            foreach($vals AS $k=>$v){
                $content .= $key.'['.(is_int($k)?'':$k).'] = "'.$v.'"'."\n";
            }
        }
        
        
    }
    return $content;
}
/*
function arr2ini(array $a, array $parent = array())
{
    $out = '';
    foreach ($a as $k => $v)
    {
        if (is_array($v))
        {
            $sec = array_merge((array) $parent, (array) $k);
            $out .= '[' . join('.', $sec) . ']' . PHP_EOL;
            $out .= arr2ini($v, $sec);
        }
        else
        {
            $out .= $k.' = "'.$v.'"' . PHP_EOL;
            //$out .= $k.' = '.(is_bool($v) ? ($v?"true":"false") : '"'.$v.'"') . PHP_EOL;
        }
    }
    return $out;
}
*/