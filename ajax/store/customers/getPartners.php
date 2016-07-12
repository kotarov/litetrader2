<?php
$where = '';
if(isset($_REQUEST['id'])) $where = " WHERE p.id = ".(int)$_REQUEST['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'customers');
$sth = $dbh->query("SELECT 
    p.is_active,
    p.is_advertise,
    p.name || ' ' || p.family name,
    p.phone,
    p.email,
    p.id as photo, p.photo_date,
    p.city || '; '|| p.address address,
    (SELECT GROUP_CONCAT(co.name) FROM partners_companies pc LEFT JOIN companies co ON (co.id = pc.id_company) WHERE pc.id_partner = p.id) company,
    
    p.id actions,
    p.id
FROM partners p $where");


$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);
return json_encode($ret);