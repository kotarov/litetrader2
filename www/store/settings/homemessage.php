<?php $exp=0; include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SETTINGS - Home Advertizing</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        
         <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.buttons.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
    </head>
    
    <body id="page-settings"> 
            <?php include '../snipps/head.php'; ?>
        
            <h2 class="page-header"><i class="uk-icon-gear"></i> <span data-lang="Message block"></span></h2>
            
            <?php  //parse_ini_file(INI_DIR."www/homeslider.ini",true); ?>
            <div class="uk-container uk-container">
                <form class="uk-form">
                    <div class="uk-form-row">
                        <label class="uk-form-label">Text</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-width-1-1" name="text"><strong>Phasellus viverra nulla ut metus.</strong> Quisque rutrum etiam ultricies nisi vel augue. <a class="uk-button uk-button-primary uk-margin-left" href="#">Button</a>    
                            </textarea>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-form-controls">
                            <button class="uk-button" type="reset" data-lang>Reset</button>
                            <button class="uk-button uk-button-primary" type="submit" data-lang>Save</button>
                        </div>
                    </div>
                </form>
            </div>
            
            
            <?php /*** Modal Delete */ ?>
            <div id="modal-delete-file" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-small">  <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header">  <h3>Delete image</h3>  </div>
                    <form action="ajax.php?f=customers/postDeleteCustomer" method="post" data-trigger="image-deleted">
                        <p>Are you sure you want to delete this image: <br>"<b name="file"></b>" ?</p>
                        <input type="hidden" name="file">
                        <input type="hidden" name="project">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger">Delete</button>
                            <button class="uk-modal-close uk-button">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        
            
            <?php include '../snipps/foot.php'; ?>
            <script src="<?=$_ASSETS['application_debug.js']?>"></script>
    </body>

</html>