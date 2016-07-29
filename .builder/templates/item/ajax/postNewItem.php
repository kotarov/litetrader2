<?php
__SANITIZE_PRICE__

$ret = array();
$post = filter_var_array($_POST,array(
    'title'=>FILTER_SANITIZE_STRING,
    __FILTER_REFERENCE__
    __FILTER_PRICE__
    __FILTER_QTY__
    __FILTER_UNIT__
    __FILTER_CATEGORY__
    __FILTER_OWNER__
    __FILTER_OWNER_COMPANY__
    __FILTER_DESCRIPTION__
    'tags' => array(
        'filter' => FILTER_SANITIZE_STRING,
        'flags'  => FILTER_FORCE_ARRAY,
    )
));

if(!$post['title']) $ret['required'][] = 'title';
__REQUIRE_PRICE__
__REQUIRE_DESCRIPTION__
if(!$post['tags']) $ret['required'][] = 'tags[]';

if(!isset($ret['required'])){
    $post['tags'] = implode(',',$post['tags']);
    $post['date_add'] = time();
    __POST_OWNER__
    __POST_OWNER_COMPANY__
    __POST_DATE_ADD__
    
    $sets = array_keys($post);
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->prepare("INSERT INTO items (".implode(',', $sets).") VALUES (:".implode(", :", $sets).")");
    $sth->execute($post);
    $_REQUEST['id'] = $dbh->lastInsertId();
    $url_rewrite = $_REQUEST['id']."-".str_replace(array(" "),"-",$post['title']);
    $dbh->query("UPDATE items SET url_rewrite='".$url_rewrite."' WHERE id = ".$_REQUEST['id']);
    include 'getItems.php';
    $ret['success'] = 'Item id='.$_REQUEST['id'].' added successful.';
}

return json_encode($ret);
