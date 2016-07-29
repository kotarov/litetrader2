<?php

$ret = array();

if(!isset($_GET['id']) || !(int)$_GET['id']) die("Wrong request !");

$date_format = '%d.%m.%Y';

$sql = "SELECT 
    p.id,
    p.name, p.surname, p.family,
    p.email, 
    p.phone,
    p.work, p.mobile, p.sip,
    p.skype, p.facebook, p.twitter,
    p.country, p.city, p.address,
    __SELECT_PARTNER_COMPANY__
    p.site,
    strftime('$date_format',date(p.birthday,'unixepoch')) birthday,
    strftime('$date_format',date(p.datetime,'unixepoch')) datetime_date, 
    strftime('%H:%M',time(p.datetime,'unixepoch')) datetime_time,
    strftime('$date_format',date(p.somedate,'unixepoch')) somedate
FROM partners p 
WHERE p.id = ".(int)$_GET['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$ret['data'] = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
return json_encode($ret);