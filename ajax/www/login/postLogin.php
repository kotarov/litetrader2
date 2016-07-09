<?php
session_start();

$ret=array();
$post = filter_var_array($_POST,array(
    'email'=>FILTER_VALIDATE_EMAIL,
    'password'=>FILTER_DEFAULT
));

if(!$post['email'])     $ret['required'][]='email';
if(!$post['password'])  $ret['required'][]='password';

if(!isset($ret['required'])){
    $post['onelogin_pass'] = $post['password'];
    $post['onelogin_time'] = time() - (60 * 30); // 30 min
    $post['password'] = md5($post['password']);

    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    
    $sql = "SELECT id FROM partners WHERE email LIKE :email "
            ."AND (password LIKE :password "
                ."OR ( onelogin_pass LIKE :onelogin_pass AND onelogin_time > :onelogin_time)"
            .") "
            ."AND is_active = 1";
    
    $sth = $dbh->prepare($sql);
    $sth->execute( $post );
    $exists = $sth->fetch(PDO::FETCH_COLUMN) ;
    if($exists){
        $_SESSION['customer'] = $dbh->query("SELECT id, name, surname, family, email, phone, skype, facebook, twitter, country, city, address FROM partners WHERE id = $exists")
            ->fetch(PDO::FETCH_ASSOC);
        $dbh->query("UPDATE partners SET date_logged = ".time()." WHERE id = $exists");
        $ret['success'] = 'Wellcom';
    }else{
        $ret['error'] = 'Wrong email or password';    
    }
}


return json_encode($ret);
?>