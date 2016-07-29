<?php
$ret=array();
$post = filter_var_array($_POST,array(
    'email'=>FILTER_VALIDATE_EMAIL,
    'password'=>FILTER_DEFAULT
));

if(!$post['email'])     $ret['required'][]='email';
if(!$post['password'])  $ret['required'][]='password';

if(!isset($ret['required'])){
    $post['password'] = md5($post['password']);

    $dbh = new PDO('sqlite:'.DB_DIR.'suppliers');
    
    $sth = $dbh->prepare( "SELECT id FROM partners WHERE email LIKE :email AND password LIKE :password AND is_active = 1" );
    $sth->execute( $post );
    $exists = $sth->fetch(PDO::FETCH_COLUMN) ;
    if($exists){
        $_SESSION['store'] = array();
        $_SESSION['store'] = $dbh->query("SELECT 
            id, name, family, 
            email, phone, 
            country, address, city
        FROM partners WHERE id = $exists")->fetch(PDO::FETCH_ASSOC);
        
        /*** ACCESS */ 
        $_SESSION['store']['access']['suppliers_companies'] = array();
        $companies = $dbh->query("SELECT c.id, c.name,  c.name text 
            FROM partners_companies pc 
            LEFT JOIN companies c ON (c.id = pc.id_company)
            WHERE pc.id_partner = $exists")->fetchAll(PDO::FETCH_ASSOC);
        foreach($companies AS $company) $_SESSION['store']['access']['suppliers_companies'][$company['id']] = $company;
        /*** //Access */
        
        $dbh->query("UPDATE partners SET date_logged = ".time()." WHERE id = $exists");
        $ret['success'] = 'Welcome';
    }else{
        $ret['access'] = 'Wrong email or password';    
    }
}


return json_encode($ret);
?>