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
    
    <body id="page-__MODULE__"> 
        <?php include '../../snipps/head.php'; ?>
        
        <h2 class="page-header" data-lang>__TITLE__ __category.title__</h2>
        <div class="uk-container">
        
        <table id="categories" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-reload="category-changed"
        ></table>

        
        <script> 
            $("#categories").DataTable({
            	dom: '<"uk-float-right uk-margin-left"B>ti',
            	ajax: "<?=URL_BASE?>ajax.php?f=__MODULE__/categories/getCategories",
            	paginate: false,
            	stateSave: true,
            	searching: false,
            	ordering: false,
            	columns: [
            		__CAT__IS_VISIBLE__
            		{ data:"id", title:"ID", width:"1em", class:"id"},
            		__CAT__IMAGE__
            		{ data:"title", title:(lang["Name"]||"Name"), class:"uk-text-nowrap" },
            		__CAT__SUBTITLE__
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
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/postNewCategory" data-trigger="category-changed">
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>__category.title__</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                        </div>
                        __CAT__FORM_SUBTITLE__
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Parent</label>
                            <div class="uk-form-controls"><select data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/getCategories&getforselect" class="uk-width-1-1" name="id_parent"></select></div>
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
            <div id="modal-edit-category" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/getCategory" data-hide-on-submit>
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Edit category</span> #<span name="id"></span></h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/postEditCategory" data-trigger="category-changed">
                        <input type="hidden" name="id">
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                        </div>
                        __CAT__FORM_SUBTITLE__
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Parent</span></label>
                            <div class="uk-form-controls"><select data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/getCategories&getforselect" class="uk-width-1-1" name="id_parent"></select></div>
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
                        if(parseInt(v,10)) $(obj).find("[value="+v+"]").prop("disabled",true);
                    });}      
                });
            </script>            
            
            
            <?php /*** Modal Delete */ ?>
            <div id="modal-delete-category" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-small">
                    <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Delete category</h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/postDeleteCategory" data-trigger="category-changed">
                        <p><span data-lang>Are you sure you want to delete this category ?</span> <div class="uk-text-muted"> <span name="name"></span> - <code>#<b name="id"></b></code> </div></p>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
          __CAT__MODAL_IMAGE__
          
          </div>
        
        <script src="<?=$_ASSETS['application.js']?>"></script>
        
        </div>
        <?php include '../../snipps/foot.php'; ?>
    </body>
</html>