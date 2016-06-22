<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT,
    'field'=>FILTER_SANITIZE_STRING
));

if(!$post['id']) $ret['error'] = 'Wrong ID !';
if(!in_array($post['field'], array('is_active','is_advertise') )) $ret['error']='Wrong request!';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    
    $value = $dbh->query("SELECT ".$post['field']." FROM partners WHERE id = ".$post['id'])->fetch(PDO::FETCH_COLUMN);
    $sth = $dbh->prepare("UPDATE partners SET ".$post['field']." = ".($value?'null':1)." WHERE id = ".$post['id']);
    if( $sth->execute() ){
        include 'getPartners.php';
        $ret['success'] = 'Successfully toggled';
        $ret['id'] = $post['id'];
    } else {
        $ret['error'] = 'Cannot toggle this value';
    }

}

return json_encode($ret);
