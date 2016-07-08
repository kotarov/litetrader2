<?php
/* Изчислява тксата на количката */
function calculateTax($id = 0, $database = 'sales', $module = 'www'){
        $ret = array( 0=>'', 1=>0, 'title'=>'',  'price'=> 0 );

        $dbh = new PDO('sqlite:'.DB_DIR.$database);
        if($id) $key = $dbh->query("SELECT key_tax FROM orders WHERE id = $id")->fetch(PDO::FETCH_COLUMN);
        else $key = '';
    
        $taxes = parse_ini_file(INI_DIR.$module.'/taxes.ini',true);
        if( isset($taxes[$key]) ){
            $ret['title'] = $ret[0]=  $taxes[$key]['title'];
            if(strpos($taxes[$key]['value'],'%') === FALSE ){
                $ret['price'] = $ret[1] = (float)$taxes[$key]['value'];
            }else{
                if(!$id){
                    $ret['price'] = $ret[1] = 0;
                }else{
                    $sum = $dbh->query("SELECT SUM(price*qty) FROM orders_items WHERE id_order=".$id)->fetch(PDO::FETCH_COLUMN);
                    $ret['price'] = $ret[1] = $sum * (float)$taxes[$key]['value'] / 100;
                }            
            }
        }
        return $ret;
}



/* Изчислява default таксата спрямо подаденатсума*/
function calculateDefaultTax($sum){
    //$tax = array('title'=>'','value'=>0,'type'=>'percent'||'value');
    
    $taxes = parse_ini_file(INI_DIR.'www/taxes.ini', true);
    $tax = reset($taxes); 
    $tax['key'] = key($taxes);
    
    if(strpos($tax['value'], '%') === FALSE ){
        $tax['value'] = (float)$tax['value'];
        $tax['type'] = 'value';
    }else{
        $tax['value'] = $sum * (float)$tax['value'] / 100;
        $tax['type'] = 'percent';
    }
    return $tax;
}