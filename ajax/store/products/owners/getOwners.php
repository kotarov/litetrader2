<?php
    
if(isset($_GET['person'])){
    $dbh = new PDO('sqlite:'.DB_DIR.'suppliers');
    $sth = $dbh->prepare("SELECT id, name||' '||family AS text FROM partners;"); $sth->execute();
    $ret['data'] = array_merge(array(array('id'=>0,'text'=>'-')), $sth->fetchAll(PDO::FETCH_ASSOC));
}else{
    if(isset($_SESSION['store']['access']['suppliers_companies'])){
        if(isset($_GET['withdash'])){
            $ret['data'] =  array_merge(array(array('id'=>0,'text'=>'-')), $_SESSION['store']['access']['suppliers_companies']);
        }else {
            $ret['data'] =  $_SESSION['store']['access']['suppliers_companies'];
        }
    }else{
        $dbh = new PDO('sqlite:'.DB_DIR.'suppliers');
        $sth = $dbh->prepare("SELECT id, name AS text FROM companies;"); $sth->execute();
        $ret['data'] = array_merge(array(array('id'=>0,'text'=>'-')), $sth->fetchAll(PDO::FETCH_ASSOC));
    }
}
    

return json_encode($ret);
