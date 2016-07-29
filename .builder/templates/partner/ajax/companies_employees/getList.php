<?php
if(!isset($_GET['id'])) exit;

$id_company = (int)$_GET['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$sth = $dbh->query("SELECT 
    c.is_active,
    c.id,
    c.name,
    c.phone,
    c.email,
    c.id photo,
    c.photo_date,
    c.id actions
FROM partners_companies cc 
LEFT JOIN partners c ON (cc.id_partner = c.id)
WHERE cc.id_company = $id_company");


$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);