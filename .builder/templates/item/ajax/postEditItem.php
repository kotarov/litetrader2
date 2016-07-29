<?php
include_once LIB_DIR.'URLRewrite.php';

__SANITIZE_PRICE__

$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
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

if(!$post['id']) exit;

if(!$post['title']) $ret['required'][] = 'title';
__REQUIRE_PRICE__
__REQUIRE_DESCRIPTION__
if(!$post['tags']) $ret['required'][] = 'tags[]';

if(!isset($ret['required'])){
    $post['tags'] = implode(',',$post['tags']);
    $post['url_rewrite'] = $post['id'].'-'.url_rewrite($post['title']);
    
    __POST_OWNER__
    __POST_OWNER_COMPANY__
    __POST_DATE_ADD__
    
    $sets = array();
    foreach(array_keys($post) AS $k=>$v){
        $sets[] = $v.'=:'.$v;
    }
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->prepare("UPDATE items SET ".implode(",", $sets)." WHERE id = :id");
    $sth->execute($post);
    include 'getItems.php';
    $ret['id'] = $post['id'];
    $ret['success'] = 'Item id='.$_REQUEST['id'].' changed.';
}

return json_encode($ret);
