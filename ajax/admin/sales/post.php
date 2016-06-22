<?php

$ret = array();
$post = filter_var_array($_POST,array(
    'id_partner'=>FILTER_VALIDATE_INT,
    'id_company'=>FILTER_VALIDATE_INT,
    'partner'=>FILTER_SANITIZE_STRING,
    'company'=>FILTER_SANITIZE_STRING,
    'ein'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_SANITIZE_STRING,
    'phone'=>FILTER_SANITIZE_STRING,
    'country'=>FILTER_SANITIZE_STRING,
    'city'=>FILTER_SANITIZE_STRING,
    'address'=>FILTER_SANITIZE_STRING
));
if(!$post['partner']) $ret['required'][] = 'partner';
if(!$post['email'] && !$post['phone']) { $ret['required'][] = 'email'; $ret['required'][] = 'phone'; }
if( $post['company'] ){
    if(!$post['ein']    ) $ret['required'][] = 'ein';
    if(!$post['country']) $ret['required'][] = 'country';
    if(!$post['city']   ) $ret['required'][] = 'city';
    if(!$post['address']) $ret['required'][] = 'address';
}



if(!isset($ret['required'])){
    if($post['id_company'] < 0) $post['id_company'] = 0; // On Edit -> if HOME address id_company = -1

    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    $NO_RETURN = true;
    
    if(isset($_POST['register-new-company'])){
        $dbh = new PDO('sqlite:'.DB_DIR.'customers');
        $sth = $dbh->prepare("INSERT INTO companies (
            name, mrp, ein, email, phone, country, city, address
        ) VALUES (
            :company, :partner, :ein, :email, :phone, :country, :city, :address
        )");
        $sth->execute(array(
            'company'=>$post['company'],
            'partner'=>$post['partner'],
            'ein'=>$post['ein'],
            'email'=>$post['email'],
            'phone'=>$post['phone'],
            'country'=>$post['country'],
            'city'=>$post['city'],
            'address'=>$post['address']
        ));
        $post['id_company'] = $dbh->lastInsertId();
        
        if(!isset($_POST['register-new-partner']) && $post['id_partner']){
            $sth = $dbh->query("INSERT INTO partners_companies (id_partner, id_company) VALUES (".$post['id_partner'].",".$post['id_company'].")");
        }
    }
    
    if(isset($_POST['register-new-partner'])){
        $name = explode(" ",$post['partner']); 
        if(!isset($name[1])) $name[1] = ''; if(!isset($name[2])) $name[2] = '';
        
        $dbh = new PDO('sqlite:'.DB_DIR.'customers');
        $sth = $dbh->prepare("INSERT INTO partners (
            name, surname, family
        )VALUES (
            :name, :surname, :family
        )");
        $sth->execute(array(
            'name'=>$name[0],
            'surname'=> ($name[1] && $name[2]) ? $name[1] : '',
            'family'=>($name[1] && $name[2]) ? $name[2] : $name[1],
        ));
        $post['id_partner'] = $dbh->lastInsertId();
        
        if($post['id_company']) {
            $sth = $dbh->query("INSERT INTO partners_companies (id_partner, id_company) VALUES (".$post['id_partner'].",".$post['id_company'].")");
        }else{
            $sth = $dbh->prepare("UPDATE partners SET email=:email, phone=:phone, country=:country, city=:city, address=:address WHERE id=:id");
            $sth->execute(array(
                'email'=>$post['email'],
                'phone'=> $post['phone'],
                'country'=>$post['country'],
                'city'=>$post['city'],
                'address'=>$post['address'],
                'id'=>$post['id_partner']
            ));
        }
    }
 
    
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    $post['date_add'] = time();
    
    if(!isset($_POST['id']) || !(int)$_POST['id']){
        $post['id_status'] = $dbh->query("SELECT id FROM statuses WHERE is_default = 1")->fetch(PDO::FETCH_COLUMN);
        if(!$post['id_status']) $post['id_status'] = 1;
        $post['number'] = $dbh->query("SELECT MAX(number) FROM orders")->fetch(PDO::FETCH_COLUMN) + 1;        
        
        $sth = $dbh->prepare("INSERT INTO orders (".implode(',', array_keys($post)).") VALUES (:".implode(", :", array_keys($post)).")");
        $sth->execute($post);
        $_REQUEST['id'] = $dbh->lastInsertId();

        $status = array('id_order'=>$_REQUEST['id'],'id_status'=>$post['id_status']);
        include 'registerStatus.php';
    }else{
        $ret['id'] = $_REQUEST['id'] = (int)$_POST['id'];
        $sets = array(); foreach(array_keys($post) AS $k=>$v){ $sets[] = $v.'=:'.$v; }
        
        $sth = $dbh->prepare("UPDATE orders SET ".implode(",", $sets)." WHERE id = ".$ret['id'] );
        $sth->execute($post);
    }
    
    
    include 'getList.php';  
    $ret['success'] = 'Order id='.$_REQUEST['id'].' added successful.';
    $ret['id'] = $_REQUEST['id'];
}

return json_encode($ret);