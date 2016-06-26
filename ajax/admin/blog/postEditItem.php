<?php
include_once LIB_DIR.'URLRewrite.php';



$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'title'=>FILTER_SANITIZE_STRING,
    
    
    
    
    "id_category"=>FILTER_VALIDATE_INT,
    
    "description"=>FILTER_SANITIZE_STRING,
    'tags' => array(
        'filter' => FILTER_SANITIZE_STRING,
        'flags'  => FILTER_FORCE_ARRAY,
    )
));

if(!$post['id']) exit;

if(!$post['title']) $ret['required'][] = 'title';

if(!$post["description"]) $ret["required"][] = "description";
if(!$post['tags']) $ret['required'][] = 'tags[]';

if(!isset($ret['required'])){
    $post['tags'] = implode(',',$post['tags']);
    $post['url_rewrite'] = $post['id'].'-'.url_rewrite($post['title']);
    
    if($_POST["date_add"] && $_POST["date_add_time"]) $post["date_add"] = strtotime($_POST["date_add"]." ".$_POST["date_add_time"]);
    
    $sets = array();
    foreach(array_keys($post) AS $k=>$v){
        $sets[] = $v.'=:'.$v;
    }
    $dbh = new PDO('sqlite:'.DB_DIR.'blog');
    $sth = $dbh->prepare("UPDATE items SET ".implode(",", $sets)." WHERE id = :id");
    $sth->execute($post);
    include 'getItems.php';
    $ret['id'] = $post['id'];
    $ret['success'] = 'Item id='.$_REQUEST['id'].' changed.';
}

return json_encode($ret);
