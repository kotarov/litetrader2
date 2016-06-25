<?php $exp=0; include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SETTINGS - Menu</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
    </head>
    
    <body id="page-settings"> 
            <?php include '../snipps/head.php'; ?>
        
            <h2 class="page-header"><i class="uk-icon-gear"></i> <span data-lang>Menus</span></h2>
            <div class="uk-container uk-container">
                    <?php $data = parse_ini_file(INI_DIR.'www/menus.ini',true);?>
                
                    <form class="uk-form uk-form-horizontal uk-width-medium-1-2 uk-container-center" action="<?=URL_BASE?>ajax.php?f=settings/postMenus">
                        
                        <fieldset data-uk-margin><legend>Public shop menu</legend>
                            
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label"> 
                                    <input  type="checkbox" name="home" value="<?=$data['public']['home']?>" <?=($data['public']['home']?"checked":"")?>>
                                    Home
                                </label>
                                <div class="uk-form-controls"> 
                                    <input  type="text" name="home_title" value="<?=$data['public']['home_title']?>" >
                                </div>
                            </div>
                            
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label"><input  type="checkbox" name="products" value="<?=$data['public']['products']?>" <?=($data['public']['products']?"checked":"")?>> 
                                    Products</label>
                                <div class="uk-form-controls">
                                    <input name="products_title" value="<?=$data['public']['products_title']?>">
                                </div>
                            </div>
                            
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label"> <input  type="checkbox" name="articles" value="<?=$data['public']['articles']?>" <?=($data['public']['articles']?"checked":"")?>> Articles</label>
                                <div class="uk-form-controls">
                                    <input name="articles_title" value="<?=$data['public']['articles_title']?>">
                                </div>
                            </div>
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label">
                                    <input  type="checkbox" name="contacts" value="<?=$data['public']['contacts']?>" <?=($data['public']['contacts']?"checked":"")?>> Contacts
                                </label>
                                <div class="uk-form-controls">
                                    <input name="contacts_title" value="<?=$data['public']['contacts_title']?>">
                                </div>
                            </div>
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label"> <input  type="checkbox" name="order" value="<?=$data['public']['order']?>" <?=($data['public']['order']?"checked":"")?>> Order</label>
                                <div class="uk-form-controls">
                                    <input name="order_title" value="<?=$data['public']['order_title']?>">
                                </div>
                            </div>
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label"> <input type="checkbox" name="login" value="<?=$data['public']['login']?>" <?=($data['public']['login']?"checked":"")?>> Login</label>
                                <div class="uk-form-controls">
                                    <input name="login_title" value="<?=$data['public']['login_title']?>">
                                </div>
                            </div>
                        </fieldset>
                        
                        <br><br>
                        
                        <div class="uk-modal-footer">
                            <button class="uk-button uk-button-primary" data-lang>Save</button>
                            <button type="reset" class="uk-button" data-lang>Reset</button>
                        </div>
                    </form>
            </div>
            <?php include '../snipps/foot.php'; ?>
            <script src="<?=$_ASSETS['application.js']?>"></script>
    </body>

</html>