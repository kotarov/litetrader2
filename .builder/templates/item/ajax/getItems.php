<?php

$where = 'WHERE 1';
if(isset($_REQUEST['id'])) $where .= " AND items.id = ".(int)$_REQUEST['id'];
if( isset($_SESSION['__PROJECT__']['access']['suppliers_companies']) ) $where .= " AND items.id_owner_company IN (".implode(',',array_keys($_SESSION['__PROJECT__']['access']['suppliers_companies'])).")";

$dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
__ATTACH_DB__

$sth = $dbh->prepare("SELECT 
    __IS_ACTIVE__ 
    __IS_VISIBLE__ 
    __IS_ADVERTISE__
    __IS_AVAIBLE__
    items.id,
    __DATE_ADD__
    __IMAGE__
    __CATEGORY__
    items.title,
    __DESCRIPTION__
    __OWNER__
    __OWNER_COMPANY__
    __REFERENCE__
    __UNIT_NAME__
    __QTY__
    __PRICE__
    items.date_avaible date,
    items.id actions
FROM items items 
__JOIN_CATEGORY__
__JOIN_IMAGES__ 
__JOIN_UNIT__
__JOIN_OWNER__
__JOIN_OWNER_COMPANY__
$where");
$sth->execute();
$ret['data'] = $sth->fetchAll(PDO::FETCH_ASSOC);

return json_encode($ret);
