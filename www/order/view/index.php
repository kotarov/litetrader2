<?php include '../../snipps/init.php'; ?>
<?php
$post = filter_var_array($_POST,array(
    'email'=>FILTER_SANITIZE_EMAIL,
    'phone'=>FITLER_SANITIZE_STRING,
    'code'=>FITLER_SANITIZE_STRING
));

if($post['email'] && $post['phone'] && $post['code']){
    $dbh = new PDO('lite:'.DB_DIR.'sales');
    $sth = $dbh->prepare("SELECT 
            id, 
            id_status,
            number,
            invoice,
            date_add,
            date_delivery,
            partner,
            company,
            mrp,
            phone,
            email,
            country,
            city,
            address,
            price,
            is_active,
            method text
        FROM orders 
        WHERE number = :code, phone = :phone, email = :email
    ");
    $sth->execute($post);
    $id_order = $sth->fetch(PDO::FETCH_ASSOC);

    /*
    method -> payment_method
    */
    
}
?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>

        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.dotnav.css']?>" />
        <script src="<?=$_ASSETS['uikit.slideset.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.lightebox.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        <link href="<?=$_ASSETS['uikit.form.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.form.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        
        <style>
            .cart-depends { display:none;}
        </style>
    </head>
    
    <body id="page-order"> 
        <?php include '../../snipps/head.php'; ?>
        <h1 data-lang>Преглед на поръчка</h1>
        
        <br>
        <form class="uk-form uk-form-horizontal uk-width-large-3-4 uk-wdth-medium-1-3">
            <div class="uk-form-row">
                <label class="uk-form-label">Email</label>
                <div class="uk-form-controls"><input class="uk-width-1-1" name="email"></div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">Телефон</label>
                <div class="uk-form-controls"><input class="uk-width-1-1" name="phone"></div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">Код</label>
                <div class="uk-form-controls"><input  class="uk-width-1-1" name="code"></div>
            </div>
            
            <div class="uk-form-row">
                <label class="uk-form-label"></label>
                <div class="uk-form-controls">
                    <button type="submit" class="uk-button" name="check">Изпрати</button>
                </div>
            </div>
        </form>
        
        
    
    
        <div class="uk-margin-large-bottom"></div>
        <script src="<?=URL_BASE?>js/application.js"></script>
        <?php include '../../snipps/foot.php'; ?>
    </body>
</html>