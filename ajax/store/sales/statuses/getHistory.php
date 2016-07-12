<?php
$date_format = '%d.%m.%Y';

$ret = array();
if(isset($_GET['id']) && (int)$_GET['id']){
    $dbh = new PDO('sqlite:'.DB_DIR.'sales');
    
    $ret['data']= $dbh->query("SELECT 
        s.icon, 
        os.status, 
        strftime('$date_format',date(os.date_add,'unixepoch'))||' '||strftime('%H:%M',time(os.date_add,'unixepoch')) date_add, 
        os.user, 
        s.color, 
        os.project  
    FROM orders_statuses os 
    LEFT JOIN statuses s ON (s.id = os.id_status) 
    WHERE os.id_order = ".(int)$_GET['id']." ORDER BY os.date_add DESC")->fetchAll(PDO::FETCH_ASSOC);
}

return json_encode($ret);