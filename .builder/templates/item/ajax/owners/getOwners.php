<?php
    
if(isset($_GET['person'])){
    if(isset($_SESSION['__PROJECT__']['access']['suppliers_persons'])){
        $ret['data'] = $_SESSION['__PROJECT__']['access']['suppliers_persons'];
    }else{
        $dbh = new PDO('sqlite:'.DB_DIR.'__owner.db__');
        $sth = $dbh->prepare("SELECT id, name||' '||family AS text FROM partners;"); $sth->execute();
        $ret['data'] = array_merge(array(array('id'=>0,'text'=>'-')), $sth->fetchAll(PDO::FETCH_ASSOC));
    }        
}else{
    if(isset($_SESSION['__PROJECT__']['access']['suppliers_companies'])){
        if(isset($_GET['withdash'])){
            $ret['data'] =  array_merge(array(array('id'=>0,'text'=>'-')), $_SESSION['__PROJECT__']['access']['suppliers_companies']);
        }else {
            $ret['data'] =  $_SESSION['__PROJECT__']['access']['suppliers_companies'];
        }
    }else{
        $dbh = new PDO('sqlite:'.DB_DIR.'__owner.db__');
        $sth = $dbh->prepare("SELECT id, name AS text FROM companies;"); $sth->execute();
        $ret['data'] = array_merge(array(array('id'=>0,'text'=>'-')), $sth->fetchAll(PDO::FETCH_ASSOC));
    }
}
    

return json_encode($ret);
