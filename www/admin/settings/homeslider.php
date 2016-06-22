<?php $exp=0; include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SETTINGS - Slider</title>
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
        
            <h2 class="page-header"><i class="uk-icon-gear"></i> <span data-lang="Images of Home Sliders"></span></h2>
            

            <?php $sliders = parse_ini_file(INI_DIR."www/homeslider.ini",true);?>
           
            <div class="uk-container uk-container">
                
            <?php foreach($sliders AS $s_name => $slider){ ?>
                <form class="uk-form uk-form-horizontal uk-container-center" action="<?=URL_BASE?>ajax.php?f=settings/postHomeslider">
                <fieldset class="uk-maring-large-top uk-margin-large-bottom"><legend><span data-lang>Slider</span>: <b><?=$s_name?></b> <small>(<?=$slider['width'].' x '.$slider['height']?>)</small></legend>
                
                    <table class="dataTable uk-table uk-table-hover uk-table-striped uk-table-condensed dataTable no-footer">
                        <thead><tr>
                            <th  class="uk-text-center">Pos</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Alt</th>
                            <th>href</th>
                            <th>Caption</th>
                            <th>Text</th>
                            <th></th>
                        </tr></thead>
                        <tbody>
                        <?php foreach ($slider['title'] AS $n => $v) { ?>
                            <tr><td class="uk-text-center"><?=$n+1?></td>
                                <td><img src="../../img/slide/<?=$slider['src'][$n]?>" width="100px"></td>
                                <td><?=$slider['title'][$n]?></td>
                                <td><?=$slider['alt'][$n]?></td>
                                <td><?=$slider['href'][$n]?></td>
                                <td><?=$slider['caption'][$n]?></td>
                                <td><?=$slider['text'][$n]?></td>
                                <td width="1em" data-sortable="false" class='uk-text-center actions'></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                
                </fieldset>
                </form>
            <?php } ?>
                <script>
                    $(".dataTable").dataTable({
                        sort:false,
                        dom: '<"uk-float-right uk-margin-left"B>rti',
                        buttons: [{	text:"New", className:"uk-button uk-button-primary",
                			init: function(dt, node, config) {  node.attr("data-uk-modal",true).attr("href","#modal-new-customer");  }
                    	}],
                    });
                </script>
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