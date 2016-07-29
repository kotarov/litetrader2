if(isset($_POST['id_company']) && is_array($_POST['id_company']) ){
        $insert = '('.$_REQUEST['id'].', '. implode("), (".$_REQUEST['id'].', ', array_values($_POST['id_company'])).')'; 
        $dbh->query("INSERT INTO partners_companies (id_partner, id_company) VALUES $insert");
    }
