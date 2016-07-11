<?php
session_start();

$post = array();
$post = filter_var_array($_POST, array(
    'email'=>FILTER_VALIDATE_EMAIL,
    'key'=>FILTER_SANITIZE_STRING
));


if( $post['key'] && $post['email']){
    $dbh = new PDO("sqlite:".DB_DIR."customers");
    $sth = $dbh->prepare("SELECT id FROM partners WHERE email LIKE :email AND `key_activate` LIKE :key");
    $sth->execute($post);
    
    $exists = $sth->fetch(PDO::FETCH_COLUMN) ;
    if($exists){
        $dbh->query("UPDATE partners SET `key_activate` = 0, is_active = 1 WHERE id=$exists");
        header("Location:".URL_BASE."customer/");
    }
}
return "Nothing to activate";