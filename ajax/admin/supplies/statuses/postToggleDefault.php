<?php
$ret = array();
$post = filter_var_array($_POST,array(
    'id'=>FILTER_VALIDATE_INT
));
if(!$post['id']) $ret['error'] = 'Wrong ID !';

if(!isset($ret['error'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'supplies');
    
    $id_old = $dbh->query("SELECT id FROM statuses WHERE is_default = 1")->fetch(PDO::FETCH_COLUMN);
    if($id_old != $post['id']){ 
        $dbh->query("UPDATE statuses SET is_default = 0");
        $sth = $dbh->prepare("UPDATE statuses SET is_default = 1 WHERE id = ".$post['id']);
        if( $sth->execute() ){
            $ret['success'] = 'Success';
        } else {
            $ret['error'] = 'Cannot set default value';
        }
    }else{
        $ret['success'] = 'Nothing changed';
    }
}

return json_encode($ret);
