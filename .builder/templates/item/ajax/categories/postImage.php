<?php
$ret = array();

if(!isset($_FILES['images'])) exit;
if(!isset($_POST['id']) || !(int)$_POST['id']) {
    if(!isset($_POST['id_parent']) || !(int)$_POST['id_parent']) exit;
    else $_POST['id'] = $_POST['id_parent'];
}
if(isset($_POST['picEditButton'])) exit;

$id_category = (int)$_POST['id'];


$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');

include LIB_DIR.'ResampleImage.php';
include LIB_DIR.'HumanFileSize.php';

//foreach($_FILES['images']['name'] AS $n=>$name){

$n = 0 ;
if(isset($_POST['picEdit'])) $n = 1;

    $sth = $dbh->prepare("
    UPDATE categories SET 
        date_image = :date_image,
        image_type = :image_type,
        image_size = :image_size,
        image = :image,
        thumb = :thumb
    WHERE id = :id");
    $s = parse_ini_file(INI_DIR.'__MODULE__/images.ini', true);
    $s = $s['categories'];
    $image = file_get_contents($_FILES['images']['tmp_name'][$n]);
    $full = resampleimage($image, $s['image']['width'], $s['image']['height'], $s['bgcolor']);
    $date_image = time();
    $sth->execute(array(
        'date_image' => $date_image,
        'image_type' => 'image/jpeg',
        'image_size' => humanfilesize( strlen($full) ),
        'image' => $full,
        'thumb' => resampleimage($image, $s['thumb']['width'], $s['thumb']['height'], $s['bgcolor']),
        'id'=>$id_category
    ));
    $_REQUEST['id'] = $id_category;
    include 'getCategories.php';
    $ret['id'] = $id_category;
    $ret['date_image'] = $date_image;
    $ret['success'] = count($_FILES['images']['name'])." <span data-lang>File(s) uploaded</span>";
//}

return json_encode($ret);