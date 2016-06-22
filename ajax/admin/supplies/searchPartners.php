<?php
$ret = array();
$search = filter_var_array($_GET,array(
    'q'=>FILTER_SANITIZE_STRING,
    'p'=>FILTER_VALIDATE_INT
));

$search['q'] = '%'.strtolower($search['q']).'%';
$search['p'] = (int)$search['p'];

$where = array();
foreach(array('p.id', 'p.name', 'p.family', 'p.phone', 'p.email', 'p.city', 'p.address', 'companies') AS $k=> $f){
    $where[] = "LOWER($f) LIKE :q";
} 
$where = implode(" OR ",$where);

$dbh = new PDO('sqlite:'.DB_DIR.'suppliers');
$sth = $dbh->prepare("SELECT 
    p.id,
    p.name||' '||p.family text,
    p.phone,
    p.photo_date,
    p.email,
    (SELECT GROUP_CONCAT(co.name) FROM partners_companies cc LEFT JOIN companies co ON (co.id = cc.id_company) WHERE cc.id_partner = p.id) companies
FROM partners p 
WHERE $where    
LIMIT :p, 10 
");
$sth->execute($search);
$ret['results'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);