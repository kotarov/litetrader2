<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        
        <link rel="stylesheet" href="<?=$_ASSETS['fotorama.css']?>">
        <script src="<?=$_ASSETS['fotorama.js']?>"></script>
        
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.dotnav.css']?>" />
        <script src="<?=$_ASSETS['uikit.slideset.js']?>"></script>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.25.0/css/components/slideshow.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.25.0/js/components/slideshow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.25.0/js/components/slideshow-fx.min.js"></script> -->
    </head>
    <body id="page-home"> 
            <?php include '../snipps/head.php'; ?>
            <?php include 'slider.php';?>
            <?php include 'promo.php';?>
            <?php include 'advertize.php';?>
            
            <?php include '../snipps/featured.php';?>
            
            <!-- Well -->
            <br>
            <div class="uk-grid uk-margin-top" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1 uk-row-first">
                    <div class="uk-panel uk-panel-box uk-text-center">
                        <p><strong>Phasellus viverra nulla ut metus.</strong> Quisque rutrum etiam ultricies nisi vel augue. <a class="uk-button uk-button-primary uk-margin-left" href="#">Button</a></p>
                    </div>
                </div>
            </div>
            <!-- //well -->


    <?php include '../snipps/foot.php';?>
    </body>
</html>