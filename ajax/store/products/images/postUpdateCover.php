<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT
));

if(!$post['id']) exit;

$dbh = new PDO('sqlite:'.DB_DIR.'products');
$_REQUEST['id'] = $dbh->query("SELECT id_item FROM images WHERE id =".$post['id'])->fetch(PDO::FETCH_COLUMN);

$was_cover = $dbh->query("SELECT is_cover FROM images WHERE id = ".$post['id'])->fetch(PDO::FETCH_COLUMN);
$sth = $dbh->query("UPDATE images SET is_cover = null WHERE id_item = ".$_REQUEST['id']);
if(!$was_cover) $sth = $dbh->query("UPDATE images SET is_cover = 1 WHERE id =".$post['id']);

include '../getItems.php';
$ret['id']=$_REQUEST['id'];

$ret['success'] = 'Image updated.';


return json_encode($ret);
