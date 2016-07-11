<?php
$ret=array();
$post=filter_var_array($_POST,array(
    'name'=>FILTER_SANITIZE_STRING,
    'family'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_VALIDATE_EMAIL,
    'password'=>FILTER_DEFAULT,
    'phone'=>FILTER_SANITIZE_STRING,
    'city'=>FILTER_SANITIZE_STRING,
    'address'=>FILTER_SANITIZE_STRING
));

if(!$post['name'])      $ret['required'][]='name';
if(!$post['email'])     $ret['required'][]='email';
if(!$post['password'])  $ret['required'][]='password';
if(!isset($_POST['repeat']) || $post['password'] != $_POST['repeat'] ) 
                        $ret['required'][]='repeat';
if(!$post['phone'])     $ret['required'][]='phone';
if(!$post['city'])      $ret['required'][]='city';
if(!$post['address'])   $ret['required'][]='address';

if(!isset($ret['required'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    $sth = $dbh->prepare("SELECT id FROM partners WHERE email LIKE :email");
    $sth->execute( array('email'=>$post['email'] ));
    $exists = $sth->fetch(PDO::FETCH_COLUMN);
    
    if($exists){
        $ret['required'][] = 'email';
        $ret['error'] = 'This email is already registered'; 
    }else{
        $post['password'] = md5($post['password']);
        $post['date_add'] = time();
        $post['key_activate'] = substr(str_shuffle(md5(time())),0,25);    
        
        $sql = "INSERT INTO partners (".implode(',', array_keys($post) ).") VALUES (:".implode(', :', array_keys($post)).")";
        $sth = $dbh->prepare( $sql );
        $sth->execute($post);

        $key_activate = $post['key_activate'];
        $urlActivate = URL_BASE.'customer/activate.php';
        $urlParams = '?email='.$post['email'].'&key='.$post['key_activate'];        
        $company = parse_ini_file(INI_DIR.'company.ini');
                
        $mail = include MAIL_DIR.'customer_registered.php';
    
        include LIB_DIR.'SMTPMailer.php';
        if(sendmail( $post['email'], $mail['title'],$mail['body'] )) {
            $ret['success'] = 'Profile created successful. Check your email for activation instructions.';
        }else{
            $ret['error'] = "Cannot send mail ! ".$sendmail_error;   
        }
    }
}


return json_encode($ret);
?>