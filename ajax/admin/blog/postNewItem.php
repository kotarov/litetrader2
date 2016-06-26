<?php


$ret = array();
$post = filter_var_array($_POST,array(
    'title'=>FILTER_SANITIZE_STRING,
    
    
    
    
    "id_category"=>FILTER_VALIDATE_INT,
    
    "description"=>FILTER_SANITIZE_STRING,
    'tags' => array(
        'filter' => FILTER_SANITIZE_STRING,
        'flags'  => FILTER_FORCE_ARRAY,
    )
));

if(!$post['title']) $ret['required'][] = 'title';

if(!$post["description"]) $ret["required"][] = "description";
if(!$post['tags']) $ret['required'][] = 'tags[]';

if(!isset($ret['required'])){
    $post['tags'] = implode(',',$post['tags']);
    $post['date_add'] = time();
    if($_POST["date_add"] && $_POST["date_add_time"]) $post["date_add"] = strtotime($_POST["date_add"]." ".$_POST["date_add_time"]);
    
    $sets = array_keys($post);
    $dbh = new PDO('sqlite:'.DB_DIR.'blog');
    $sth = $dbh->prepare("INSERT INTO items (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    $sth->execute($post);
    $_REQUEST['id'] = $dbh->lastInsertId();
    $url_rewrite = $_REQUEST['id']."-".str_replace(array(" "),"-",$post['title']);
    $dbh->query("UPDATE items SET url_rewrite='".$url_rewrite."' WHERE id = ".$_REQUEST['id']);
    include 'getItems.php';
    $ret['success'] = 'Item id='.$_REQUEST['id'].' added successful.';
}

return json_encode($ret);
