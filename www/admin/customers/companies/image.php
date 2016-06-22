<?php
$exp = 2592000;  //30days (60sec * 60min * 24hours * 30days)
include '../../snipps/init.php';

if(isset($_SERVER['PATH_INFO'])){
    list($temp,$id,$size) = explode("/",$_SERVER['PATH_INFO']);
 
    $dbh = new PDO('sqlite:'.DB_DIR.'customers');
    $sth = $dbh->query("SELECT logo FROM companies WHERE id = $id");
    $image = $sth->fetch(PDO::FETCH_COLUMN);
    if(!$image) {
        $noimage = "../../img/no-customers-companies-logo.jpg";
        if(!file_exists($noimage)){
            include LIB_DIR.'ResampleImage.php';
            $s = parse_ini_file(INI_DIR.'customers/images.ini', true);
            $s = $s['company'];
            
            $ii=file_get_contents('../../img/no-logo.png');
            file_put_contents($noimage, resampleimage($ii, $s['image']['width'], $s['image']['height'], $s['bgcolor']));
        }
        $image = file_get_contents( $noimage );
    }
    header('Content-type: image/jpeg');
    echo $image;
}