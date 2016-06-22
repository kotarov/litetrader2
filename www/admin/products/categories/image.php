<?php
$exp = 2592000;  //30days (60sec * 60min * 24hours * 30days)
include '../../snipps/init.php';

if(isset($_SERVER['PATH_INFO'])){
    list($temp,$id,$size) = explode("/",$_SERVER['PATH_INFO']);
    if(!in_array($size, array('thumb'))) $size = 'image';
 
    $dbh = new PDO('sqlite:'.DB_DIR.'products');
    $sth = $dbh->query("SELECT $size AS image FROM categories WHERE id = $id");
    $image = $sth->fetch(PDO::FETCH_COLUMN);
    
    
    if(!$image) {
        $noimage = "../../img/no-products-category-$size.jpg";
        if(!file_exists($noimage)){
            include LIB_DIR.'ResampleImage.php';
            $s = parse_ini_file(INI_DIR.'products/images.ini', true);
            $s = $s['categories'];
            
            $ii=file_get_contents('../../img/no-image.png');
            file_put_contents($noimage, resampleimage($ii, $s[$size]['width'], $s[$size]['height'], $s['bgcolor']));
        }
        $image = file_get_contents( $noimage );
    }
    
    header('Content-type: image/jpeg');
    echo $image;
}