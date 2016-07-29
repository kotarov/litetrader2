<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>__TITLE__</title>
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
        
         <link  href="<?=$_ASSETS['uikit.autocomplete.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.datepicker.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.datepicker.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.timepicker.js']?>"></script>
        
        
        <link  href="<?=$_ASSETS['codemirror.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['codemirror.js']?>"></script>
        <script src="<?=$_ASSETS['codemirror.marked.js']?>"></script>
        <script src="<?=$_ASSETS['codemirror.xml.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.htmleditor.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['uikit.htmleditor.js']?>"></script>
        <link href="<?=URL_BASE?>css/richedit.css" rel="stylesheet">        
        
        <script src="<?=$_ASSETS['tinymce.js']?>"></script>

        <link href="<?=$_ASSETS['picedit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['picedit.js']?>"></script>
        
        
        <script src="<?=$_ASSETS['highlight.js']?>"></script>
        
        <link  href="<?=$_ASSETS['select2.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['select2.js']?>"></script>
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
        <script src="<?=$_ASSETS['chart.sparkline.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
    </head>
    
    <body id="page-__MODULE__"> 
        <?php include '../snipps/head.php'; ?>
        
        <?php //session_start(); print_r($_SESSION);exit; ?>
        <h2 class="page-header"><span data-lang>__TITLE__</span> <span class="uk-margin-left page-sparkline" data-table="__DB__"></span></h2>
        
        <div class="uk-container">
        <table id="items" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-add="item-added"
            data-trigger-update="item-updated"
            data-trigger-delete="item-deleted"
        ></table>

        
        <script> 
            $("#items").DataTable({
            	dom: '<"uk-float-right uk-margin-left"B><"uk-float-right"f>lrtip',
            	ajax: "<?=URL_BASE?>ajax.php?f=__MODULE__/getItems",
            	stateSave: true,
            	order: [[ 4, "desc" ]],
            	columns: [
            		__LSIT__IS_VISIBLE__
            		__LSIT__IS_AVAIBLE__
            		__LSIT__IS_ACTIVE__
            		__LSIT__IS_ADVERTISE__
            		{ data:"id", title:(lang["ID"]||"ID"), width:"1em", class:"id uk-text-center"},
            		
            		__LSIT__IMAGE__
            		{ data:"title", title:(lang["__title.title__"]||"__title.title__")__REFERENCE__},
            		__LIST__DATE_ADD__
            		__LSIT__CATEGORY__
            		__LSIT__OWNER__
            		__LIST__OWNER_COMPANY__
            		__LSIT__PRICE__
            		__LSIT__QTY__
            		__LSIT__UNIT__
            		{ data:"actions", title:"", width:"1em", orderable:false, searchable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
            			render: function(d,t,r){return ''
            			+'<a href="#modal-edit-item" data-uk-modal class="uk-icon-edit" data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Edit"></a>'
            			+'<a href="#modal-edit-item-content-re" data-uk-modal class="uk-icon-file-text" data-get="id='+r.id+'"data-populate=\'{"id":"'+r.id+'","product":"'+r.title+'"}\'  title="Details"></a>'
            			+'<a href="#modal-edit-item-content-script" data-uk-modal class="uk-icon-file-code-o" data-get="id='+r.id+'"data-populate=\'{"id":"'+r.id+'","product":"'+r.title+'"}\'  title="Details"></a>'
            			+'<a href="#modal-delete-item" data-uk-modal class="uk-icon-trash" data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Delete"></a>';
            			},
            		}
            	],
            	buttons: [
            	    {	text:"New", className:"uk-button uk-button-primary",
                		init: function(dt, node, config){ node.attr("data-uk-modal",true).attr("href","#modal-new-item"); }
                	},
                	__BUTTON__OWNER__
                	__BUTTON__OWNER_COMPANY__
                	
        		],
                fnDrawCallback:function(settings){ $("tbody",this[0]).unhighlight().highlight( this.api().search().split(" ") ); }
            });
            
            $.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
            	if( $(settings.nTable).attr("id") !== "items" ) return true;
            	var ret = true;
            	__FILTER__OWNER_COMPANY__
            	__FILTER__OWNER__
            	
        		return ret;
            });
            

        </script>
            
        <div>
            <?php /*** Modal New */?>
            <div id="modal-new-item" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Create new</h3></div>
                    
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/postNewItem" data-trigger="item-added">
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>__title.title__</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                            </div>
                            __FORM__REFERENCE__
                            __FORM__DESCRIPTION__
                            __FORM__DATE_ADD__
                            __FORM__PRICE__
                            __FORM__QTY__
                            <?php /*__FORM__UNIT__*/?>
                            __FORM__CATEGORY__  
                            __FORM__OWNER__
                            __FORM__OWNER_COMPANY__
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Tags</span>  <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls">
                                    <select class="uk-width-1-1 select2" style="width:100%" 
                                                data-tags="true" 
                                                multiple 
                                                data-tokenSeparators='[",", " "]' 
                                                name="tags[]"
                                            ></select>
                                    <p class="uk-form-help-block"><span data-lang>Separate tags with</span> <code data-lang>comma</code>, <code data-lang>space</code> or <code>&lt;Еnter&gt;</code>.</p>
                                </div>
                            </div>
                        
                        <div class="uk-modal-footer">
                            <button class="uk-button uk-button-primary" data-lang>Save</button>
                            <button class="uk-button uk-modal-close"data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php /*** Modal Edit */ ?>
            <div id="modal-edit-item" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/getItem" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Edit item</span> #<span class="uk-text-muted" name="id"></span></h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/postEditItem" data-trigger="item-updated">
                            <input type="hidden" name="id">
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>__title.title__</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                            </div>
                            __FORM__REFERENCE__
                            __FORM__DESCRIPTION__
                            __FORM__DATE_ADD__
                            __FORM__PRICE__
                            __FORM__QTY__
                            <?php /*__FORM__UNIT__*/?>
                            __FORM__CATEGORY__
                            __FORM__OWNER__
                            __FORM__OWNER_COMPANY__
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Tags</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls">
                                    <select class="uk-width-1-1 select2" style="width:100%" 
                                        data-tags="true" 
                                        multiple 
                                        data-tokenSeparators='[",", " "]' 
                                        name="tags[]"
                                    ></select>
                                    <p class="uk-form-help-block"><span data-lang>Separate tags with</span> <code data-lang>comma</code>, <code data-lang>space</code> or <code>&lt;Еnter&gt;</code>.</p>
                                </div>
                            </div>
                        
                        <div class="uk-modal-footer">
                            <button class="uk-button uk-button-primary" data-lang>Save</button>
                            <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <?php /*** Modal Item Content RICHEDIT */ ?>
            <div id="modal-edit-item-content-re" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/getItemContent" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-large uk-modal-dialog-lightbox">
                    <a href="" class="uk-modal-close uk-close uk-close-alt" style="z-index:1"></a>
                    <form id="form-editor-item-content" class="uk-form" action="<?=URL_BASE?>ajax.php?f=__MODULE__/postItemContent" data-trigger="item-updated">
                        <textarea id="editor-item-content" class="uk-width-1-1" name="content" 
                            data-tinymce
                            data-formats = '{"first-letter": {"block" : "p", "class" : "first-letter", "attributes":{"title":"My first letter"} }}'
                            data-style_formats_merge="true" 
                            data-style_formats='[ { "title": "First letter", "block": "p", "classes": "first-letter"} ]'
                            data-height="450px" 
                            data-content_css = "<?=URL_BASE?>css/richedit.css"
                            data-body_class="mce-body"
                            data-plugins='["advlist autolink lists link image charmap print preview anchor","searchreplace visualblocks code fullscreen","insertdatetime media table contextmenu paste code imagetools image"]'
                            data-toolbar= 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image' 
                            data-language_url="<?=URL_BASE?>js/tinymce/bg_BG.js"
                            data-relative_urls="false"
                            data-image_list_url_eval='"<?=URL_BASE?>ajax.php?f=blog/images/getMCEList&id="+$("#editor-item-content").closest("form").find("[name=id]").val()'
                            data-image_advtab="true"
                            data-image_dimensions= "false"
                        ></textarea>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button class="uk-button uk-button-primary"data-lang>Save</button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <?php /*** Modal Item Content SCRIPT */ ?>
            <div id="modal-edit-item-content-script" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/getItemContent&forscript" data-hide-on-submit>
                <style scoped>a[data-htmleditor-button="fullscreen"] {display:none!important}</style>
                <div class="uk-modal-dialog uk-modal-dialog-large uk-modal-dialog-lightbox">
                    <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                    <form class="uk-form" action="<?=URL_BASE?>ajax.php?f=__MODULE__/postItemContent" data-trigger="item-updated">
                        <textarea class="uk-width-1-1" name="content_script" data-uk-htmleditor="{maxsplitsize:600}" data-mode="text/html"></textarea>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button class="uk-button uk-button-primary"data-lang>Save</button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                    <div class="uk-modal-caption"><i><b class="uk-text-muted">Code Editor</b> of item content:</i> "<b class="uk-text-warning" name="product"></b>"</div>
                </div>
            </div>
            
            <?php /*** Modal Delete */ ?>
            <div id="modal-delete-item" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-small"><a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header">
                        <h3 data-lang>Delete item</h3>
                    </div>
                    <form action="<?=URL_BASE?>ajax.php?f=__MODULE__/postDeleteItem" method="post" data-trigger="item-deleted">
                        <p><span data-lang>Are you sure you want to delete item</span> #<b name="id"></b> ?</p>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                            <button class="uk-modal-close uk-button"data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>


            __MODAL__IMAGE__
            
        
        </div>
        
        <script src="<?=$_ASSETS['application.js']?>"></script>
        
        </div>
        <?php include '../snipps/foot.php'; ?>
    </body>
</html>