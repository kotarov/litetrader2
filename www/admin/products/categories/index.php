<?php include '../../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Categories</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.form.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.form.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.buttons.js']?>"></script>
        
        <link  href="<?=$_ASSETS['select2.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['select2.js']?>"></script>
        
        <link href="<?=$_ASSETS['picedit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['picedit.js']?>"></script>
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
        <style>
            .uk-table-condensed td { padding-top:0px;padding-bottom:0px}
        </style>
    </head>
    
    <body id="page-products"> 
        <?php include '../../snipps/head.php'; ?>
        
        <h2 class="page-header" data-lang>Products Category</h2>
        <div class="uk-container">
        
        <table id="categories" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-reload="category-changed"
        ></table>

        
        <script> 
            $("#categories").DataTable({
            	dom: '<"uk-float-right uk-margin-left"B>ti',
            	ajax: "<?=URL_BASE?>ajax.php?f=products/categories/getCategories",
            	paginate: false,
            	stateSave: true,
            	searching: false,
            	ordering: false,
            	columns: [
            		{ data:"is_visible", title:(lang["Vis"]||"Vis"), width:"1em", class:"uk-text-center", render:function(d,t,r){
            		    return '<a href="<?=URL_BASE?>ajax.php?f=products/categories/postToggleCategory" class="uk-icon-eye'+(d?'':'-slash uk-text-muted')+'" data-toggle="is_visible" data-trigger="category-changed" data-post=\'{"id":"'+r.id+'"}\'></a>';
            		}},
            		{ data:"id", title:"ID", width:"1em", class:"id"},
            		{ data:"image", title:(lang["Image"]||"Image"), width:"1em", orderable:false, searchable:false,
            			render: function ( d, t, r ) {
            				return '<a href="#modal-image-category" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'","size":"'+r.image_size+'"}\''
            				            +' onclick=\'$(document).trigger("category-changed-image",{\"id\":\"'+r.id+'\",\"date_image\":\"'+r.date_image+'\"})\'>'
            						+'<img src="image.php/'+d+'/thumb/'+r.date_image+'" width="40" ></a>';
            			}
            		},
            		{ data:"title", title:(lang["Name"]||"Name"), class:"uk-nowrap" },
            		{ data:"subtitle", title:(lang["Descrition"]||"Descrition")},
            		{ data:"position", title:(lang["Pos"]||"Pos"), width:"1em","class":"uk-text-center"},
            		{ data:"actions", title:"", width:"1em", orderable:false, searchable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
            			render: function(d,t,r){return ''
            			+'<a href="#modal-edit-category" class="uk-icon-edit" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Edit"></a>'
            			+'<a href="#modal-delete-category" class="uk-icon-trash" data-uk-modal data-populate=\'{"id":"'+r.id+'","name":"'+r.title.replace(/\||&nbsp;/g,"")+'"}\' data-get="id='+r.id+'" title="Delete"></a>'
            			},
            		}
            	],
            	buttons: [{	text:(lang["New"]||"New"), className:"uk-button uk-button-primary",
                	init: function(dt, node, conf){ node.attr("data-uk-modal",true).attr("href","#modal-new-category"); } 
            	}]
            });
        </script>
            
        <div>
            <?php /*** Modal New */?>
            <div id="modal-new-category" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Create new category</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=products/categories/postNewCategory" data-trigger="category-changed">
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Category</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Description</span></label>
                            <div class="uk-form-controls"><textarea class="uk-width-1-1" name="subtitle"></textarea></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Parent</label>
                            <div class="uk-form-controls"><select data-get="<?=URL_BASE?>ajax.php?f=products/categories/getCategories&getforselect" class="uk-width-1-1" name="id_parent"></select></div>
                            <script>$(document).on("category-changed", function(e,d){
                                var select = $("#modal-new-category [name=id_parent]").html("").append('<option value="0">-</option>');
                                $.each(d.data, function(r,k){
                                    select.append('<option value="'+k.id+'">'+(k.text||k.name||k.title)+'</option>');
                                })
                            })</script>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Position</label>
                            <div class="uk-form-controls"><input type="number" class="uk-width-1-1" name="position"></div>
                        </div>
                        <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Tags</span>  <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls">
                                    <select class="uk-width-1-1 select2" style="width:100%" 
                                                data-tags="true" 
                                                multiple 
                                                data-tokenSeparators='[",", " "]' 
                                                name="tags[]"
                                            ></select>
                                    <p class="uk-form-help-block"><span data-lang>Separate tags with</span> <code data-lang>comma</code>, <code data-lang>space</code> <span data-lang>or</span> <code>&lt;Еnter&gt;</code>.</p>
                                </div>
                            </div>
                        <div class="uk-modal-footer">
                            <button class="uk-button uk-button-primary upload-progress" data-lang>Save</button>
                            <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <?php /*** Modal Edit */ ?>
            <div id="modal-edit-category" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=products/categories/getCategory" data-hide-on-submit>
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Edit category</span> #<span name="id"></span></h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=products/categories/postEditCategory" data-trigger="category-changed">
                        <input type="hidden" name="id">
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Description</span></label>
                            <div class="uk-form-controls"><textarea class="uk-width-1-1" name="subtitle"></textarea></div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Parent</span></label>
                            <div class="uk-form-controls"><select data-get="<?=URL_BASE?>ajax.php?f=products/categories/getCategories&getforselect" class="uk-width-1-1" name="id_parent"></select></div>
                            <script>$(document).on("category-changed", function(e,d){
                                var select = $("#modal-edit-category [name=id_parent]").html("").append('<option value="0">-</option>');
                                $.each(d.data, function(r,k){
                                    select.append('<option value="'+k.id+'">'+(k.text||k.name||k.title)+'</option>');
                                })
                            })</script>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Position</span></label>
                            <div class="uk-form-controls"><input type="number" class="uk-width-1-1" name="position"></div>
                        </div>
                        
                        <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Tags</span>  <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls">
                                    <select class="uk-width-1-1 select2" style="width:100%" 
                                                data-tags="true" 
                                                multiple 
                                                data-tokenSeparators='[",", " "]' 
                                                name="tags[]"
                                            ></select>
                                    <p class="uk-form-help-block"><span data-lang>Separate tags with</span> <code data-lang>comma</code>, <code data-lang>space</code> <span data-lang>or</span> <code>&lt;Еnter&gt;</code>.</p>
                                </div>
                        </div>
                        <div class="uk-modal-footer">
                            <button class="uk-button uk-button-primary upload-progress" data-lang>Save</button>
                            <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $("#modal-edit-category").on("populated",function(e,ret){
                    var obj = $("[name=id_parent]", this);
                    $("option[disabled]", obj).prop("disabled",false);
                    var children = ret.data[0]['children'];
                    if(children){ $.each(children.split(","), function(k,v){
                        $(obj).find("[value="+v+"]").prop("disabled",true);
                    });}      
                });
            </script>            
            
            
            <?php /*** Modal Delete */ ?>
            <div id="modal-delete-category" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-small">
                    <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Delete category</h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=products/categories/postDeleteCategory" data-trigger="category-changed">
                        <p><span data-lang>Are you sure you want to delete this category ?</span> <div class="uk-text-muted"> <span name="name"></span> - <code>#<b name="id"></b></code> </div></p>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <?php /*** Modal image */?>
            <?php $s = parse_ini_file(INI_DIR.'products/images.ini',true); $s=$s['categories'];?>
            
            <div id="modal-image-category" class="uk-modal" >
                <div class="uk-modal-dialog uk-modal-dialog-large"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Image of category</span> #<span name="id"></span></h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=products/categories/postImage" data-trigger="category-changed,category-changed-image">
                        <div class="uk-grid">
                            <div class="uk-width-small-2-3">
                                <div> <span data-lang>Full size</span>  <b name="size"></b> (<?=$s['image']['width'].' x '.$s['image']['height'];?>):</div>
                                <img id="categry-delimg-image"class="uk-thumbnail" src="image.php/1/image/">
                            </div>
                            <div class="uk-width-small-1-3">
                                <div><span data-lang>Thumbnail</span> (<?=$s['thumb']['width'].' x '.$s['thumb']['height'];?>):</div>
                                <img id="categry-delimg-thumb" class="uk-thumbnail" src="image.php/1/thumb/">
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="file" id="select-category-image" name="images[]" class="uk-hidden" onchange="if($(this).val()) $(this).closest('form').submit()">
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
                $(document).on("category-changed-image",function(e,ret){
                    $("#categry-delimg-image").attr("src","image.php/"+ret.id+"/image/"+ret.date_image);
            		$("#categry-delimg-thumb").attr("src","image.php/"+ret.id+"/thumb/"+ret.date_image); 
                });
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
                $('#modal-tune-upload-image .picEdit').picEdit({
                    formSubmitted: function(res){
                        var result = $.parseJSON(res.response);
                        
                        $(document).trigger("category-changed",result);
                        $(document).trigger("category-changed-image",result);
                        
                        UIkit.modal( $("#modal-tune-upload-image") ).hide();
                    }                 
                });
            </script>
          
          </div>
        
        <script src="<?=$_ASSETS['application.js']?>"></script>
        
        </div>
        <?php include '../../snipps/foot.php'; ?>
    </body>
</html>