<?php
//print_r($_SESSION);exit;

    $date_add = $_SESSION['order']['date_add'];    
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    
    $post = $_SESSION['order'];
    $post['date_add'] = time();//strtotime($post['date_add']);
    $post['price']=$post['total']; unset($post['total']);
    $post['is_active']=1;
    $post['id_status'] = $dbh->query("SELECT id, name FROM statuses WHERE is_default = 1")->fetch(PDO::FETCH_COLUMN);
   
    $sth = $dbh->prepare("INSERT INTO orders (".implode(',', array_keys($post)).") VALUES (:".implode(", :", array_keys($post)).")");
    if($sth->execute($post)){
        $id_order = $dbh->lastInsertId();
        $dbh->query('ATTACH DATABASE "'.DB_DIR.'products" AS "pr"');
        
        $status = array();
        $status['id_order'] = $id_order;
        $status['id_status'] = $post['id_status'];
        $status['status'] = $dbh->query("SELECT name FROM statuses WHERE id = ".$post['id_status'])->fetch(PDO::FETCH_COLUMN);
        $status['user'] = $post['partner'];
        $status['project'] = 'Online shop';
        $status['date_add'] = $post['date_add'];
        $sth = $dbh->prepare("INSERT INTO orders_statuses (".implode(',', array_keys($status)).") VALUES (:".implode(", :", array_keys($status)).")");
        $sth->execute($status);
    
        $p = array();
        $p['id_order'] = $id_order;
        $p['date_add'] = $post['date_add'];
        foreach($_SESSION['cart'] AS $n => $c){
            $p['id_item'] =  $c['id'];
            $p['item'] = $c['title'].' '.$c['reference'];
            $p['note'] = '';
            $p['id_unit'] = $dbh->query("SELECT id_unit FROM pr.items WHERE id = ".$c['id'])->fetch(PDO::FETCH_COLUMN);
            $p['unit'] = $c['unit'];
            $p['qty'] = $c['qty'];
            $p['price'] = $c['price'];

            $sth = $dbh->prepare("INSERT INTO orders_items (".implode(',', array_keys($p)).") VALUES (:".implode(", :", array_keys($p)).")");
            $sth->execute($p);
        }
        
        unset($_SESSION['cart']);
        unset($_SESSION['order']);

        $ret['order'] = array('id'=>$id_order,'date_add'=>$date_add,'email'=>$post['email']);
        $ret['success'] = "OK";
    }

    return $ret;