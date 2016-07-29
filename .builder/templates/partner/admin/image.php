<?php
$exp = 2592000;  //30days (60sec * 60min * 24hours * 30days)
include '../snipps/init.php';

if(isset($_SERVER['PATH_INFO'])){
    list($temp,$id,$size) = explode("/",$_SERVER['PATH_INFO']);
 
    $dbh = new PDO('sqlite:'.DB_DIR.'__DB__');
    $sth = $dbh->query("SELECT photo FROM partners WHERE id = $id");
    $image = $sth->fetch(PDO::FETCH_COLUMN);
    if(!$image) {
        $noimage = "../img/no-__MODULE__-photo.jpg";
        if(!file_exists($noimage)){
            include LIB_DIR.'ResampleImage.php';
            $s = parse_ini_file(INI_DIR.'__MODULE__/images.ini', true);
            $s = $s['profile'];
            
            $ii=file_get_contents('../img/no_profile.png');
            file_put_contents($noimage, resampleimage($ii, $s['image']['width'], $s['image']['height'], $s['bgcolor']));
        }
        $image = file_get_contents( $noimage );
    }
    header('Content-type: image/jpeg');
    echo $image;
}