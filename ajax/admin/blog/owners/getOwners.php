<?php
$dbh = new PDO('sqlite:'.DB_DIR.'suppliers');
if(isset($_GET['person'])){
    $sql = "SELECT id, name||' '||family AS text FROM partners;";
}else{
    $sql = "SELECT id, name AS text FROM companies;";
}

$sth = $dbh->prepare($sql);
$sth->execute();
$ret['data'] = array_merge(array(array('id'=>0,'text'=>'-')),$sth->fetchAll(PDO::FETCH_ASSOC));

return json_encode($ret);
