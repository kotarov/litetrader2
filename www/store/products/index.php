<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Products</title>
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
    
    <body id="page-products"> 
        <?php include '../snipps/head.php'; ?>
        
        <?php //session_start(); print_r($_SESSION);exit; ?>
        <h2 class="page-header"><span data-lang>Products</span> <span class="uk-margin-left page-sparkline" data-table="products"></span></h2>
        
        <div class="uk-container">
        <?php /*    
             <div class="uk-float-right uk-form  uk-button-danger uk-margin-left">
                <select class="uk-text-contrast" style="background:transparent!important;" name="owner">
                        <option>Edno</option>
                        <option>Dve</option>
                        <option> Tri</option>
                    </select>
            </div>
        */?>
        <table id="items" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-add="item-added"
            data-trigger-update="item-updated"
            data-trigger-delete="item-deleted"
        ></table>

        
        <script> 
            $("#items").DataTable({
            	dom: '<"uk-float-right uk-margin-left"B><"uk-float-right"f>lrtip',
            	ajax: "<?=URL_BASE?>ajax.php?f=products/getItems",
            	stateSave: true,
            	order: [[ 4, "desc" ]],
            	columns: [
            		{ data:"is_visible", title:"Vis", searchable:false, width:"2em",
                    	render: function(d,t,r){
                    		var icon = (d == 1) ? "uk-icon-eye uk-text-success" : "uk-icon-eye-slash uk-text-muted";
                    		return '<a href="<?=URL_BASE?>ajax.php?f=products/postToggleItem" data-trigger="item-updated" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_visible" class="'+icon+'"><i hidden>'+d+'</i></a>';
                    	}
                    },
            		{ data:"is_avaible", title:"Av", width:"2em",
            		    render: function(d,t,r){
            				var icon = (d == 1) ? "uk-icon-cart-arrow-down" : "uk-icon-ban uk-text-muted";
            				return '<a href="<?=URL_BASE?>ajax.php?f=products/postToggleItem" data-trigger="item-updated" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_avaible" class="'+icon+'"><i hidden>'+d+'</i></a>';
            			}
                    },
            		
            		{ data:"is_advertise", title:"Ad", width:"1em", class:"uk-text-center", render: function(d,t,r){
            		    var icon = (d==1) ? "uk-icon-flag uk-text-danger" : "uk-icon-flag-o uk-text-muted";
            		    return '<a href="<?=URL_BASE?>ajax.php?f=products/postToggleItem" data-trigger="item-updated" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_advertise" class="'+icon+'"><i hidden>'+d+'</i></a>';
            		}},
            		{ data:"id", title:(lang["ID"]||"ID"), width:"1em", class:"id uk-text-center"},
            		
            		{ data:"image", title:(lang["Image"]||"Image"), orderable:false, searchable:false,
            			render: function ( d, t, r ) { var badge = r.nb_images > 0 ? '<sup class="uk-badge">'+r.nb_images+'</sup>' : '';
            				return '<a href="#modal-image-item" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\'>'
            						+'<img src="image.php/'+d+'/small/'+r.date_image+'" width="40" >'+badge+'</a>';
            		}},
            		{ data:"title", title:(lang["Name"]||"Name"), render:function(d,t,r){return d+(r.reference?' <small class="uk-text-muted">/ '+r.reference+'</small>':'');}},
            		{ data:"date_add", title:(lang["Date"]||"Date")},
            		{ data:"category", title:(lang["Category"]||"Category"),render:function(d,t,r){
            		    return r.cat_is_visible == 1 ? (d?d:"") : '<strike class="uk-text-muted">'+(d?d:"")+'</strike>';
            		}},
            		
            		{ data:"owner_company", title:(lang["Office"]||"Office") },
            		{ data:"price", title:(lang["Price"]||"Price"), width:"3em", "class":"dt-right"},
            		{ data:"qty", title:(lang["Qty"]||"Qty"), width:"3em","class":"uk-text-right uk-text-nowrap",render:function(d,t,r){return d;}},
            		{ data:"unit", title:(lang["M.Unit"]||"M.Unit"), width:"3em","class":"uk-text-right uk-text-nowrap"},
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
                	
                	{	text:'<select id="filterOwnerCompany" data-get="<?=URL_BASE?>ajax.php?f=products/owners/getOwners&company&withdash" onChange="$(\'#items\').DataTable().draw()"></select>',
            			className:"uk-float-left uk-margin-right "
            		},
                	
        		],
                fnDrawCallback:function(settings){ $("tbody",this[0]).unhighlight().highlight( this.api().search().split(" ") ); }
            });
            
            $.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
            	if( $(settings.nTable).attr("id") !== "items" ) return true;
            	var ret = true;
            	if(!window['index_owner_company']) $.each(settings.oInit.columns,function(k,v){ if(v.data == 'owner_company') window['index_owner_company'] = k;})
        		if($("#filterOwnerCompany option:selected").text() !== data[window['index_owner_company']] && $("#filterOwnerCompany").val() !== '0') ret = false;

            	
            	
        		return ret;
            });
            

        </script>
            
        <div>
            <?php /*** Modal New */?>
            <div id="modal-new-item" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Create new</h3></div>
                    
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=products/postNewItem" data-trigger="item-added">
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                            </div>
                             <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Reference</label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="reference"></div>
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Description</span>  <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><textarea class="uk-width-1-1" name="description"></textarea></div>
                            </div>
                            <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>Date</span></label>
                        <div class="uk-form-controls">
                            <div class="uk-width-small-1-2 uk-grid uk-grid-collapse" style="margin-left:0">
                                <input class="uk-width-small-2-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="date_add">
                                <div class="uk-width-small-1-3">
                                    <input class="uk-width-1-1" type="text" placeholder="__:__" data-uk-timepicker="{format:'24h'}" name="date_add_time">
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Price</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="price"></div>
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Qty</label>
                                <div class="uk-form-controls uk-grid">
                                    
                                    <input class="uk-width-1-2" type="text" name="qty">
                                    <select class="uk-width-1-2" data-get="<?=URL_BASE?>ajax.php?f=products/units/getUnits" type="text" name="id_unit"></select>
                                </div>
                            </div>
                            <?php /*<div class="uk-form-row">
                                <label class="uk-form-label" data-lang>M.Unit</label>
                                <div class="uk-form-controls"><select class="uk-width-1-1" data-get="<?=URL_BASE?>ajax.php?f=products/units/getUnits" type="text" name="id_unit"></select></div>
                            </div>*/?>
                             <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Category</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><select class="uk-width-1-1" data-get="<?=URL_BASE?>ajax.php?f=products/categories/getCategories&getforselect" name="id_category"></select></div>
                                <script>$(document).on("categories-changed", function(e,d){
                                    var select = $("#modal-new-item [name=id_category]").html('<option value="0">-</option>');
                                    $.each(d.data, function(r,k){select.append('<option value="'+k.id+'" data-lang>'+k.name+'</option>');});
                                });</script>
                            </div>  
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Office</label>
                                <div class="uk-form-controls uk-grid uk-grid-collapse">
                                    <div class="uk-width-1-1"><select class="uk-width-1-1 select2" style="width:100%"
                                        name="id_owner_company"
                                        data-get="<?=URL_BASE?>ajax.php?f=products/owners/getOwners&company" 
                                        data-templateSelection='{{text}}'
                                        data-templateResult='{{text}}'
                                    ></select></div>
                                    
                                </div>
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
            <div id="modal-edit-item" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=products/getItem" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Edit item</span> #<span class="uk-text-muted" name="id"></span></h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=products/postEditItem" data-trigger="item-updated">
                            <input type="hidden" name="id">
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="title"></div>
                            </div>
                             <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Reference</label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="reference"></div>
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Description</span>  <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><textarea class="uk-width-1-1" name="description"></textarea></div>
                            </div>
                            <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>Date</span></label>
                        <div class="uk-form-controls">
                            <div class="uk-width-small-1-2 uk-grid uk-grid-collapse" style="margin-left:0">
                                <input class="uk-width-small-2-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="date_add">
                                <div class="uk-width-small-1-3">
                                    <input class="uk-width-1-1" type="text" placeholder="__:__" data-uk-timepicker="{format:'24h'}" name="date_add_time">
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Price</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="price"></div>
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Qty</label>
                                <div class="uk-form-controls uk-grid">
                                    
                                    <input class="uk-width-1-2" type="text" name="qty">
                                    <select class="uk-width-1-2" data-get="<?=URL_BASE?>ajax.php?f=products/units/getUnits" type="text" name="id_unit"></select>
                                </div>
                            </div>
                            <?php /*<div class="uk-form-row">
                                <label class="uk-form-label" data-lang>M.Unit</label>
                                <div class="uk-form-controls"><select class="uk-width-1-1" data-get="<?=URL_BASE?>ajax.php?f=products/units/getUnits" type="text" name="id_unit"></select></div>
                            </div>*/?>
                             <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>Category</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><select class="uk-width-1-1" data-get="<?=URL_BASE?>ajax.php?f=products/categories/getCategories&getforselect" name="id_category"></select></div>
                                <script>$(document).on("categories-changed", function(e,d){
                                    var select = $("#modal-new-item [name=id_category]").html('<option value="0">-</option>');
                                    $.each(d.data, function(r,k){select.append('<option value="'+k.id+'" data-lang>'+k.name+'</option>');});
                                });</script>
                            </div>
                            
                            <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Office</label>
                                <div class="uk-form-controls uk-grid uk-grid-collapse">
                                    <div class="uk-width-1-1"><select class="uk-width-1-1 select2" style="width:100%"
                                        name="id_owner_company"
                                        data-get="<?=URL_BASE?>ajax.php?f=products/owners/getOwners&company" 
                                        data-templateSelection='{{text}}'
                                        data-templateResult='{{text}}'
                                    ></select></div>
                                    
                                </div>
                            </div>
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
            <div id="modal-edit-item-content-re" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=products/getItemContent" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-large uk-modal-dialog-lightbox">
                    <a href="" class="uk-modal-close uk-close uk-close-alt" style="z-index:1"></a>
                    <form id="form-editor-item-content" class="uk-form" action="<?=URL_BASE?>ajax.php?f=products/postItemContent" data-trigger="item-updated">
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
            <div id="modal-edit-item-content-script" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=products/getItemContent&forscript" data-hide-on-submit>
                <style scoped>a[data-htmleditor-button="fullscreen"] {display:none!important}</style>
                <div class="uk-modal-dialog uk-modal-dialog-large uk-modal-dialog-lightbox">
                    <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                    <form class="uk-form" action="<?=URL_BASE?>ajax.php?f=products/postItemContent" data-trigger="item-updated">
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
                    <form action="<?=URL_BASE?>ajax.php?f=products/postDeleteItem" method="post" data-trigger="item-deleted">
                        <p><span data-lang>Are you sure you want to delete item</span> #<b name="id"></b> ?</p>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                            <button class="uk-modal-close uk-button"data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>


            <?php /*** Modal Image */?>
            <div id="modal-image-item" class="uk-modal">
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Images of product</span> #<span name="id" class="uk-text-muted"></span></h3> </div>
                    
                    <table id="list-item-images" cellspacing="0" width="100%" 
                        data-trigger-reload="item-image-changed" 
                        data-get="<?=URL_BASE?>ajax.php?f=products/images/getImages" 
                        class="dataTable uk-table uk-table-hover uk-table-striped uk-table-condensed" 
                    >
                    </table>
                    <script>$("#list-item-images").DataTable({
                        dom: 't',
                        paginate: false,
                        order: [[ "2", "asc" ]],
                        columns: [
                            { data: "is_cover", title:(lang["Cover"]||"Cover"), width:"1em", "class":"uk-text-center",orderable:false,render:function(d,t,r){
                                return '<a href="<?=URL_BASE?>ajax.php?f=products/images/postUpdateCover" data-toggle data-post=\'{"id":"'+r['id']+'"}\' data-trigger="item-image-changed,item-updated" class="'+(d?"uk-icon-star":"uk-icon-star-o")+'"></a>';
                            }},
                            { data:"id", title:"", orderable:false, sortable:false, render:function(d,t,r){
                                return '<a href="#dialog-preview-image" data-id="'+r['id']+'" data-uk-modal="{modal:false}" data-get="id='+r['id']+'" data-populate=\'{"id":"'+r['id']+'"}\'><img width="40" src="image.php/'+r['id']+'/small/'+r['date_add']+'"></a>';
                            }   },
                            { data:"name", title:(lang['Name']||"Name") },
                            { data: "size", title:(lang["Size"]||"Size"),"class":"uk-text-right" },
                            { data: "actions", title:"", searchable:false, orderable:false, class:"uk-text-center uk-text-middle uk-text-nowrap actions",
                                render:function(d,t,r,m){
                                    return '<a href="#modal-delete-image" onclick=\'$("#delete-image-preview").attr("src","image.php/'+r['id']+'/small/'+r['date_add']+'")\' class="uk-icon-times" data-uk-modal="{modal:false}" data-populate=\'{"id":"'+r['id']+'"}\' title="Remove"></a>';
                            }   }
                        ]
                    });</script>
                                    
                    <form id="form-product-upload-image" action="<?=URL_BASE?>ajax.php?f=products/images/postImages" data-trigger="item-image-changed,item-updated">
                        <input type="hidden" name="id">
                        <input type="file" id="select-product-image-files" name="images[]" multiple class="uk-hidden" onchange="if($(this).val()) $(this).closest('form').submit()">
                        <div class="uk-text-right">
                            <span class="upload-progress" data-lang>Upload:</span>
                            <a href="#modal-tune-upload-image" data-uk-modal='{modal:false}' onclick="$('#modal-tune-upload-image [name=id]').val($('#form-product-upload-image [name=id]').val());" class="uk-button uk-button-primary" ><i class="uk-icon-object-group"></i> <span data-lang>Tune upload</span></a>
                            <button type="button" class="uk-button uk-button-success" onclick="$('#select-product-image-files').click()"><i class="uk-icon-cloud-upload"></i> <span data-lang>Quick upload</span></button>
                            <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php /*** Modal Tune Upload IMAGE */ ?>
             <div id="modal-tune-upload-image" class="uk-modal no-ajax" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Tune Upload image</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=products/images/postImages" data-trigger="item-image-changed,item-updated" method="post">
                        <input type="hidden" name="id_parent">
                        <input type="hidden" name="picEdit" value="1">
                        <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Name</label>
                                <div class="uk-form-controls"> 
                                    <input class="uk-width-1-1" type="text" name="name"> 
                                    <p class="uk-form-help-block" data-lang>Live blank to keep original image name</p>
                                </div>
                        </div>
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
                        
                        $(document).trigger("item-image-changed",result);
                        $(document).trigger("item-updated",result);
                        
                        UIkit.modal( $("#modal-tune-upload-image") ).hide();
                    }                 
                });
            </script>
            <?php /*** Modal Delete IMAGE */ ?>
            <div id="modal-delete-image" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-small"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Delete image</h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=products/images/postDelete" data-trigger="item-image-changed,item-updated">
                        <p><span data-lang>Are you sure you want to delete this image from item</span> #<b name="id_parent"></b> ?</p>
                        <div><img id="delete-image-preview"></div>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php /*** Modal Preview Image */ ?>
            <div id="dialog-preview-image" class="uk-modal">
                <div class="uk-modal-dialog uk-modal-dialog-blank"> <button class="uk-modal-close uk-close" type="button"></button>
                    <div class="uk-grid uk-flex-middle" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-2 uk-height-viewport uk-cover-background uk-row-first" style="background-image: url('image.php/0/full');"></div>
                        <div class="uk-width-medium-1-2">
                        <h1 data-lang>Image details</h1>
                            <div class="uk-width-medium-1-1">
                                <p><dl class="uk-description-list-horizontal image-details"></dl></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $("#modal-image-item").on("click","[href='#dialog-preview-image']",function(e){ e.preventDefault();
                    var id = $(this).data("id");
                    var dlg = "#dialog-preview-image";
                    $.getJSON("<?=URL_BASE?>ajax.php?f=products/images/getInfo&id="+id).done(function(ret){
                        console.log(ret);
                        $(dlg).find(".uk-cover-background").css("background-image","url('image.php/"+id+"/full/"+ret.data[0]['date_add']+"')")
                        $(dlg).find(".image-details").html("").append(''
                            +'<dt data-lang>Image</dt><dd>'+ret.data[0]['name']+' (ID:'+ret.data[0]['id']+')</dd>'
                            +'<dt data-lang>Type</dt><dd>'+ret.data[0]['type']+'</dd>'
                            +'<dt data-lang>Size</dt><dd>'+ret.data[0]['size']+'</dd>'
                            +'<dt data-lang>Cover</dt><dd>'+(ret.data[0]['is_cover']?'Yes':'No')+'</dd>'
                            +'<dt data-lang>Product</dt><dd>'+ret.data[0]['item']+' (ID: '+ret.data[0]['id_product']+')</dd>'
                            +'<dt>&nbsp;</dt><dd>&nbsp;</dd>'
                            
                            +'<dt class="uk-text-muted">Small</dt><dd><b class="uk-text-muted">Thumb</b></dd>'
                            +'<dt><img src="image.php/'+ret.data[0]['id']+'/small/'+ret.data[0]['date_add']+'"> </dt>'
                            +'<dd><img src="image.php/'+ret.data[0]['id']+'/thumb/'+ret.data[0]['date_add']+'"> </dd>'
                        );
                    });
                });
            </script>
       
            
        
        </div>
        
        <script src="<?=$_ASSETS['application.js']?>"></script>
        
        </div>
        <?php include '../snipps/foot.php'; ?>
    </body>
</html>