$dbh=new PDO("sqlite:".DB_DIR."__owner.db__");
$post['owner'] = $dbh->query("SELECT name FROM partners WHERE id=".$post['id_owner'])->fetch(PDO::FETCH_COLUMN);

