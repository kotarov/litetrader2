<?php
$ret = array();

if(!isset($_FILES['images'])) exit;
if(!isset($_POST['id']) || !(int)$_POST['id']) {
    if(!isset($_POST['id_parent']) || !(int)$_POST['id_parent']) exit;
    else $_POST['id'] = $_POST['id_parent'];
}
if(isset($_POST['picEditButton'])) exit;

$id_partner = (int)$_POST['id'];


$dbh = new PDO('sqlite:'.DB_DIR.'customers');

include LIB_DIR.'ResampleImage.php';
include LIB_DIR.'HumanFileSize.php';

//foreach($_FILES['images']['name'] AS $n=>$name){

$n = 0 ;
if(isset($_POST['picEdit'])) $n = 1;

    $sth = $dbh->prepare("
    UPDATE partners SET 
        photo_date = :photo_date,
        photo_type = :photo_type,
        photo_size = :photo_size,
        photo = :photo
    WHERE id = :id");
    $s = parse_ini_file(INI_DIR.'customers/images.ini', true);
    $s = $s['profile'];
    $image = file_get_contents($_FILES['images']['tmp_name'][$n]);
    $full = resampleimage($image, $s['image']['width'], $s['image']['height'], $s['bgcolor']);
    $date_image = time();
    $sth->execute(array(
        'photo_date' => $date_image,
        'photo_type' => 'image/jpeg',
        'photo_size' => humanfilesize( strlen($full) ),
        'photo' => $full,
        //'thumb' => resampleimage($image, $s['thumb']['width'], $s['thumb']['height'], $s['bgcolor']),
        'id'=>$id_partner
    ));
    $_REQUEST['id'] = $id_partner;
    include 'getPartners.php';
    $ret['id'] = $id_partner;
    $ret['photo_date'] = $date_image;
    $ret['success'] = count($_FILES['images']['name'])." <span data-lang>Image file uploaded</span>";
//}

return json_encode($ret);