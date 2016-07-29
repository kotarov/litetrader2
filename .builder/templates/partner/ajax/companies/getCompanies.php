<?php
$where = '';
if(isset($_REQUEST['id'])) $where = " WHERE c.id = ".(int)$_REQUEST['id'];

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
$sth = $dbh->prepare("SELECT 
    c.id,
    c.id logo,
    c.logo_date,
    c.name,
    c.email,
    c.phone,
    c.mrp,
    c.ein,
    c.city || '; '|| c.address AS address,
    c.id actions,
    (SELECT COUNT(*) FROM partners_companies WHERE id_company = c.id ) nb_employees    
FROM companies c 
$where");
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);