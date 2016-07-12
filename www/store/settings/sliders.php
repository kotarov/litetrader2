<?php $exp=0; include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SETTINGS - Sliders</title>
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
        
            <h2 class="page-header"><i class="uk-icon-gear"></i> <span data-lang="Sliders"></span></h2>
            

            <?php $sliders = parse_ini_file(INI_DIR."www/sliders.ini",true);?>
           
            <div class="uk-container uk-container uk-form">
                
            <?php foreach($sliders AS $s_name => $slider){ ?>
                <fieldset class="uk-maring-large-top uk-margin-large-bottom"><legend><span data-lang>Slider</span>: <b><?=$s_name?></b> <small>(<?=$slider['width'].' x '.$slider['height']?>)</small></legend>
                
                    <table id="table_<?=$s_name?>" class="uk-table uk-table-hover uk-table-striped uk-table-condensed dataTable no-footer"
                        1data-trigger-reload="<?=str_replace(array(" "),'-',$s_name)?>-changed"
                        data-trigger-reload="slider-changed"
                    ></table>
                
                </fieldset>
                <script>
                    $("#table_<?=$s_name?>").dataTable({
                        sort:false,
                        ajax:"<?=URL_BASE?>ajax.php?f=settings/slider/getItems&n=<?=$s_name?>",
                        dom: '<"uk-float-right uk-margin-left"B>rti',
                        buttons: [{	text:"New", className:"uk-button uk-button-primary",
                			init: function(dt, node, config) {  node.attr("data-uk-modal",true).attr("href","#modal-new-item").attr("data-populate",'{"slider":"<?=$s_name?>"}');  }
                    	}],
                    	columns: [
                    	    {data:"id", width:"1em","class":"uk-text-center uk-text-nowrap",render:function(d,t,r){
                    	        var up = (r.id > 1 )? '<a href="<?=URL_BASE?>ajax.php?f=settings/slider/postToggle&d=up&slider=<?=$s_name?>&pos='+d+'" class="uk-icon-caret-up" data-toggle="pos" data-trigger="slider-changed"></a>' : '';
                    	        var down = (r.id < r.all && r.all != 1)?'<a href="<?=URL_BASE?>ajax.php?f=settings/slider/postToggle&d=down&slider=<?=$s_name?>&pos='+d+'" class="uk-icon-caret-down" data-toggle="pos" data-trigger="slider-changed"></a>' : '';
                    	        return up + ' ' + down;
                    	    }},
                    	    {data:"src",    title:"Photo", width:"100px",render:function(d,t,r){
                                return '<a href="#modal-image-slider" data-populate=\'{"id":"'+r.id+'","width":"<?=$slider['width']?>","height":"<?=$slider['height']?>","sliderview":"../../img/slide/'+r.src+'","size":"'+r.size+'"}\' data-uk-modal> <img src="../../img/slide/'+d+'" width="100px"> </a>';	        
                    	    }},
                    	    {data:"alt",    title: (lang["Alt"]||"Alt"), render:function(d,t,r){return "<i>"+d+"</i>"}},
                    	    {data:"title",  title: "Title", "class":"uk-text-bold"},
                    	    {data:"text",   title: "Text"},
                            {data:"href",   title: "Link (url)",render:function(d,t,r){return '<a href="'+d+'" target="_null">'+d+'</a>';}},
                    	    {data:"actions",title: "",width:"1em","class":"actions uk-text-center uk-text-nowrap",render:function(d,t,r){
                    	        var del = '<a href="#modal-delete-item" class="uk-icon-trash" data-uk-modal data-populate=\'{"id":"'+r.id+'","alt":"'+r.alt+'","slide":"<?=$s_name?>","slide-image":"../../img/slide/'+r.src+'"}\'></a>';
                    	        var edit = '<a href="#modal-edit-item" class="uk-icon-edit" data-uk-modal data-get="id='+r.id+'&slide=<?=$s_name?>"></a>';
                    	        return edit + ' '+ del;
                    	    }}
                    	]
                    });
                    
                </script>
            <?php } ?>
            </div>
            
            
            <?php /*** Modal New */ ?>
            <div id="modal-new-item" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>New item</span></h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=settings/slider/postNewItem" data-trigger="slider-changed">
                        <input type="hidden" name="slider">
                        
                         <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Image name</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="src"></div>
                        </div>
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Image Alt</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="alt"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Title</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Text</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="text"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Link on click (url)</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="href" placeholder="http://www.link.to"></div>
                        </div>
                        
                        <div class="uk-modal-footer">
                            <button class="uk-button uk-button-primary upload-progress" data-lang>Save</button>
                            <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <?php /*** Modal Edit */ ?>
            <div id="modal-edit-item" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=settings/slider/getItem" data-hide-on-submit>
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Edit item</span> #<span name="id"></span></h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=settings/slider/postEditItem" data-trigger="slider-changed">
                        <input type="hidden" name="slider">
                        <input type="hidden" name="id">
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Image name</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="src"></div>
                        </div>
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Image Alt</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="alt"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Title</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Text</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="text"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Link on click (url)</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" name="href" placeholder="http://www.link.to"></div>
                        </div>
                        
                        <div class="uk-modal-footer">
                            <button class="uk-button uk-button-primary upload-progress" data-lang>Save</button>
                            <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            
            <?php /*** Modal Delete */ ?>
            <div id="modal-delete-item" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-small">  <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header">  <h3>Delete item</h3>  </div>
                    <form action="<?=URL_BASE?>ajax.php?f=settings/slider/postDeleteItem" method="post" data-trigger="slider-changed">
                        <p>Are you sure you want to delete this item ? <br>
                        <img src="" name="slide-image" width="200px"> <br><i name="alt"></i></p>
                        
                        <input type="hidden" name="id">
                        <input type="hidden" name="slide">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        
            
            
            <?php /*** Modal image */?>
            <div id="modal-image-slider" class="uk-modal" >
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Image of slider</span> #<span name="id"></span></h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=settings/slider/postImage" data-trigger="slider-changed,slider-changed-image">
                        <div class="uk-grid">
                            <div class="uk-width-small-1-1">
                                <div> <span data-lang>Width</span>: <b name="width"></b>px; <span data-lang>Height</span>: <b name="height"></b>px; <span data-lang>Size</span>: <b name="size"></b></div>
                                <img id="categry-delimg-image" src="" name="sliderview">
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="file" id="select-category-image" name="images[]" class="uk-hidden" onchange="$(this).closest('form').submit()">
                        <br>
                        <div class="uk-text-right">
                            <span class="upload-progress" data-lang>Upload:</span>
                            <a href="#modal-tune-upload-image" data-uk-modal='{modal:false}' onclick="$('#modal-tune-upload-image [name=id]').val($('#form-product-upload-image [name=id]').val());" class="uk-button uk-button-primary" ><i class="uk-icon-object-group"></i> <span data-lang>Tune upload</span></a>
                            <button type="button" class="uk-button uk-button-success" onclick="$('#select-category-image').click()" data-lang>Quick upload</span></button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                /*$(document).on("category-changed-image",function(e,ret){
                    $("#categry-delimg-image").attr("src","image.php/"+ret.id+"/image/"+ret.date_image);
            		$("#categry-delimg-thumb").attr("src","image.php/"+ret.id+"/thumb/"+ret.date_image); 
                });*/
            </script>

            
            <?php /*** Modal Tune Upload IMAGE */ ?>
             <div id="modal-tune-upload-image" class="uk-modal no-ajax" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Tune Upload image</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=products/categories/postImage" data-trigger="category-changed,category-changed-image" method="post">
                        <input type="hidden" name="id_parent">
                        <input type="hidden" name="picEdit" value="1">
                        
                        <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Image</label>
                                <div class="uk-form-controls"> <input type="file" name="images[]" class="picEdit"> </div>
                        </div>
                        <br>

                        <div class="uk-form-controls"> 
                            <div class="uk-float-left">
                                <button type="button" class="uk-button uk-button-success" onclick='$("#modal-tune-upload-image").find(".ico-picedit-picture").click();' ><i class="uk-icon-file-image-o"></i> <span data-lang>Load</button>
                                <button type="button" class="uk-button uk-button-success" onclick='$("#modal-tune-upload-image").find(".ico-picedit-camera").click();' ><i class="uk-icon-camera"></i> <span data-lang>Photo</button>
                            </div>
                            <div class="uk-text-right">
                                <button type="submit" class="uk-button uk-button-primary" name="picEditButton"><i class="uk-icon-cloud-upload"></i> <span data-lang>Upload</span></button>
                                <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                /*$('#modal-tune-upload-image .picEdit').picEdit({
                    formSubmitted: function(res){
                        var result = $.parseJSON(res.response);
                        
                        $(document).trigger("category-changed",result);
                        $(document).trigger("category-changed-image",result);
                        
                        UIkit.modal( $("#modal-tune-upload-image") ).hide();
                    }                 
                });*/
            </script>

            
            
            
            <?php include '../snipps/foot.php'; ?>
            <script src="<?=$_ASSETS['application.js']?>"></script>

            
    </body>

</html>