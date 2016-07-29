$dbh=new PDO("sqlite:".DB_DIR."__owner.db__");
$post['owner_company'] = $dbh->query("SELECT name FROM companies WHERE id=".$post['id_owner_company'])->fetch(PDO::FETCH_COLUMN);
