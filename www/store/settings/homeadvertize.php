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
        
            <h2 class="page-header"><i class="uk-icon-gear"></i> <span data-lang="Advertizing blocks"></span></h2>
            

            <?php $items = array(
                array('title'=>'Sample Heading','icon'=>'uk-icon-cog','text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'), 
                array('title'=>'Sample Heading','icon'=>'uk-icon-thumbs-o-up','text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                array('title'=>'Sample Heading','icon'=>'uk-icon-cloud-download','text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                
                array('title'=>'Sample Heading','icon'=>'uk-icon-dashboard','text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                array('title'=>'Sample Heading','icon'=>'uk-icon-comments','text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                array('title'=>'Sample Heading','icon'=>'uk-icon-briefcase','text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
            ); //parse_ini_file(INI_DIR."www/homeslider.ini",true);
            ?>
            <div class="uk-container uk-container">
                <table class="dataTable uk-table uk-table-hover uk-table-striped uk-table-condensed dataTable no-footer">
                    <thead><tr>
                        <th  class="uk-text-center">Pos</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Text</th>
                        <th></th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($items AS $n=>$item) { ?>
                        <tr><td class="uk-text-center"><?=$n+1?></td>
                            <td><i class="<?=$item['icon']?> uk-text-primary uk-icon-large"></i></td>
                            <td><?=$item['title']?></td>
                            <td><?=$item['text']?></td>
                            <td width="1em" data-sortable="false" class='uk-text-center actions'></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

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