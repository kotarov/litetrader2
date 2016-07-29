<?php

$ret = array();

if(!isset($_FILES['images'])) exit;

$post =filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT, 
    'id_parent'=>FILTER_VALIDATE_INT,
    'name'=>FILTER_SANITIZE_STRING
));

if(!$post['id']) $post['id'] = $post['id_parent'];
if(!$post['id']) exit;

$id_item = $post['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');

include LIB_DIR.'ResampleImage.php';
include LIB_DIR.'HumanFileSize.php';

if(isset($_POST['picEditButton'])) exit;
if(isset($_POST['picEdit'])){
    foreach($_FILES['images'] AS $k => $v) unset($_FILES['images'][$k][0]);
    if($post['name']) $_FILES['images']['name'][1] = $post['name'];
}

foreach($_FILES['images']['name'] AS $n=>$name){
    $sth = $dbh->prepare("
        INSERT INTO images (
            id_item, name, `type`, size, date_add, full, thumb, small 
        ) VALUES (
            :id_item, :name, :type, :size, :date_add, :full, :thumb, :small
        )");
    $s = parse_ini_file(INI_DIR.'__MODULE__/images.ini', true);
    $s = $s['items'];
    $image = file_get_contents($_FILES['images']['tmp_name'][$n]);
    $full = resampleimage($image, $s['full']['width'], $s['full']['height'], $s['bgcolor']);
    $sth->execute(array(
        'id_item'=>$id_item,
        'name' => $_FILES['images']['name'][$n],
        'type'=> 'image/jpeg',
        'size' => humanfilesize( strlen($full) ),
        'date_add'=>time(),
        'full' => $full,
        'thumb' => resampleimage($image, $s['thumb']['width'], $s['thumb']['height'], $s['bgcolor']),
        'small' => resampleimage($image, $s['small']['width'], $s['small']['height'], $s['bgcolor'])
    ));
    $_REQUEST['id'] = $id_item;
    $ret['id'] = $id_item;
    include '../getItems.php';
    $ret['success'] = count($_FILES['images']['name'])." File(s) uploaded";
}

return json_encode($ret);