<?php 
$ret = array('data'=>false,'success'=>'ok');
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'email'=>FILTER_SANITIZE_EMAIL,
    'date_add'=>FILTER_SANITIZE_STRING
));

if($post['id'] && $post['email'] && $post['date_add']){
    $tstart = strtotime($post['date_add'].' 00:00:00');
    $tend = strtotime($post['date_add'].' 23:59:59');
    
    //print_r($tstart."...".$tend."...".strtotime('+1 day', strtotime($post['date_dd'])));exit;
    
    unset($post['date_add']);
    
    /*
    print_r("SELECT 
            o.id, 
            o.id_status,
            o.number,
            o.invoice,
            strftime('%d.%m.%Y',datetime(o.date_add,'unixepoch')) date_add,
            o.date_delivery,
            o.partner customer,
            o.company,
            o.mrp,
            o.phone, o.email,
            o.country, o.city, o.address,
            o.price,
            o.is_active,
            o.delivery_method,
            o.delivery_price, o.payment_method,
            o.tax, o.tax_price
        FROM orders o
        WHERE o.id = ".$post['id']." AND o.email like '".$post['email']."' AND o.date_add > $tstart AND o.date_add < $tend
    ");exit; /**/
    
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    $sth = $dbh->prepare("SELECT 
            o.id, 
            o.id_status,
            o.number,
            o.invoice,
            strftime('%d.%m.%Y',datetime(o.date_add,'unixepoch')) date_add,
            o.date_delivery,
            o.partner customer,
            o.company,
            o.mrp,
            o.phone, o.email,
            o.country, o.city, o.address,
            o.price,
            o.is_active,
            o.delivery_method,
            o.delivery_price, o.payment_method,
            o.tax, o.tax_price
        FROM orders o
        WHERE o.id = :id AND o.email like :email AND o.date_add >= $tstart AND o.date_add <= $tend
    ");
    $sth->execute($post);
    $ret['data'] = $sth->fetch(PDO::FETCH_ASSOC);
    $ret['success'] = 'ok';

    if($ret['data']){
        $ret['statuses'] = $dbh->query("SELECT 
                os.status, 
                os.user, 
                strftime('%d.%m.%Y',datetime(os.date_add,'unixepoch')) date_add 
            FROM orders_statuses os 
            WHERE id_order=".$post['id']."
            ORDER BY os.date_add DESC"
        )->fetchAll(PDO::FETCH_ASSOC);
        
        $ret['cart'] = $dbh->query("SELECT
                oi.item,
                oi.note,
                oi.unit,
                oi.qty,
                oi.price,
                strftime('%d.%m.%Y',datetime(oi.date_add,'unixepoch')) date_add
            FROM orders_items oi 
            WHERE oi.id_order = ".$post['id']."
        ")->fetchAll(PDO::FETCH_ASSOC);
        $ret['sum'] = $dbh->query("SELECT SUM(qty*price) FROM orders_items WHERE id_order=".$post['id'])->fetch(PDO::FETCH_COLUMN);
        
        $ret['total'] = $ret['sum'] + $ret['data']['delivery_price'] + $ret['data']['tax_price'];
        
        
        $ret['sum'] = number_format( $ret['sum'],2 );
        $ret['data']['delivery_price'] = number_format( (float)$ret['data']['delivery_price'],2 );
        $ret['data']['tax_price'] = number_format( $ret['data']['tax_price'],2 );
        $ret['total'] = number_format( $ret['total'],2 );
    }
}

return json_encode($ret);
