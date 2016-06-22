<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
));

if(!$post['id']) $ret['error'] = 'Wrong ID !';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    $sth = $dbh->prepare("
    UPDATE partners SET 
        photo_date = :photo_date,
        photo_type = :photo_type,
        photo_size = :photo_size,
        photo = :photo
    WHERE id = :id");
    
    $sth->execute(array(
        'photo_date' => 0,
        'photo_type' => '',
        'photo_size' => 0,
        'photo' => null,
        'id'=>$post['id']
    ));
    $_REQUEST['id'] = $post['id'];
    include 'getPartners.php';
    $ret['id'] = $post['id'];
    $ret['photo_date'] = '';
    $ret['success'] = "<span data-lang>Image removed.</span>";

}

return json_encode($ret);