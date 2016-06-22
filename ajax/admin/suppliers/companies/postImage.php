<?php
$ret = array();

if(!isset($_FILES['images'])) exit;
if(!isset($_POST['id']) || !(int)$_POST['id']) {
    if(!isset($_POST['id_parent']) || !(int)$_POST['id_parent']) exit;
    else $_POST['id'] = $_POST['id_parent'];
}
if(isset($_POST['picEditButton'])) exit;

$id_company = (int)$_POST['id'];


$dbh = new PDO('sqlite:'.DB_DIR.'suppliers');

include LIB_DIR.'ResampleImage.php';
include LIB_DIR.'HumanFileSize.php';

//foreach($_FILES['images']['name'] AS $n=>$name){

$n = 0 ;
if(isset($_POST['picEdit'])) $n = 1;

    $sth = $dbh->prepare("
    UPDATE companies SET 
        logo_date = :logo_date,
        logo_size = :logo_size,
        logo = :logo
    WHERE id = :id");
    $s = parse_ini_file(INI_DIR.'suppliers/images.ini', true);
    $s = $s['company'];
    $image = file_get_contents($_FILES['images']['tmp_name'][$n]);
    $full = resampleimage($image, $s['image']['width'], $s['image']['height'], $s['bgcolor']);
    $date_image = time();
    $sth->execute(array(
        'logo_date' => $date_image,
        'logo_size' => humanfilesize( strlen($full) ),
        'logo' => $full,
        'id'=>$id_company
    ));
    $_REQUEST['id'] = $id_company;
    include 'getCompanies.php';
    $ret['id'] = $id_company;
    $ret['logo_date'] = $date_image;
    $ret['success'] = count($_FILES['images']['name'])." <span data-lang>Image file uploaded</span>";
//}

return json_encode($ret);