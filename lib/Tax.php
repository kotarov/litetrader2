<?php
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