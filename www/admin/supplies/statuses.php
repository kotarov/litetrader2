<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Order statuses</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        
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
        
        <script src="<?=$_ASSETS['highlight.js']?>"></script>
        
        <link  href="<?=$_ASSETS['select2.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['select2.js']?>"></script>
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
    </head>
    
    <body id="page-suppliers"> 
        <?php include '../snipps/head.php'; ?>
        
        <h2 class="page-header" data-lang>Orders statuses</h2>
        <div class="uk-container">
        
        <table id="statuses" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" 
            data-trigger-add="status-added"
            data-trigger-update="status-updated"
            data-trigger-delete="status-deleted" 
            data-trigger-reload="status-reload" 
        ></table>
        <script> 
            $("#statuses").DataTable({
            	dom: '<"uk-float-right uk-margin-left"B><"uk-float-right"f>lrtip',
            	ajax: "<?=URL_BASE?>ajax.php?f=supplies/statuses/getList",
            	stateSave: true,
            	order:[[2,'asc']],
            	columns: [
            		{ data:'is_default', title:"",width:"1em",orderable:false,searchable:false,"class":"uk-text-center uk-text-middle actions", render: function(d,t,r){
            		    return '<a href="<?=URL_BASE?>ajax.php?f=supplies/statuses/postToggleDefault" data-post=\'{"id":"'+r.id+'"}\' data-toggle data-trigger="status-reload" '+(d==1?'class="uk-icon-play" title="Default">':'class="uk-text-muted" title="Make default">-')+'</a>';
            		}},
            		{ data:'is_closed', title:"", width:"1em",orderable:false, searchable:false, "class":"uk-text-center uk-text-middle actions", 
            		    render:function(d,t,r){ return '<a href="<?=URL_BASE?>ajax.php?f=supplies/statuses/postToggle" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_closed" data-trigger="status-updated" '+(d?'class="uk-icon-lock"':'class="uk-icon-unlock uk-text-muted"')+'></a>';
            		}  },
            		{ data:'id', title:(lang["Id"]||"Id"), width:"1em","class":"uk-text-center uk-text-middle id" },
            		{ data:'icon', title:(lang["Icon"]||"Icon"), width:"1em", orderable:false, searchable:false,class:"uk-text-center uk-text-middle",
            		    render: function(d,t,r){ return '<i class="'+d+'" style="color:'+r.color+'"></i>'; }
            		},
            		{ data:'name', title:(lang['Name']||"Name")  },
            		{ data:'actions', title:"", width:"1em", orderable:false, searchable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
            		    render: function(d,t,r){return ''
            			+'<a href="#modal-edit-status" data-uk-modal class="uk-icon-edit" data-get="id='+d+'" data-populate=\'{"id":"'+d+'"}\' title="Edit"></a>'
            			+'<a href="#modal-delete-status" data-uk-modal class="uk-icon-trash" data-post=\'{"id":"'+d+'"}\' data-populate=\'{"id":"'+d+'"}\' title="Delete"></a>';
            		}   }
            	],
            	buttons: [{	text:"New", className:"uk-button uk-button-primary",
            		init: function(dt, node, config){ node.attr("data-uk-modal",true).attr("href","#modal-new-status"); }
            	}],
                fnDrawCallback:function(settings){ $("tbody",this[0]).unhighlight().highlight( this.api().search().split(" ") ); }
            });    		
        </script>
        
        
        <?php /*** Modal NEW */ ?>
         <div id="modal-new-status" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3 data-lang>New status</h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=supplies/statuses/postNew" data-trigger="status-added">

                    <div class="uk-form-row">
                        <label class="uk-form-label">fa-Icon <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <select class="uk-width-1-1 select2" data-get="<?=URL_BASE?>ajax.php?f=getIcons" style="width:100%" name="icon"
                                data-templateResult='<i class="{{id}}"></i> {{text}}</span>'
                                data-templateSelection='<i class="{{id}}"></i> {{text}}</span>'
                            ></select>
                        </div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="name"></div>
                    </div>
                     <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Color</label>
                        <div class="uk-form-controls">
                            <input type="color" name="color" placeholder="#000000">
                        </div>
                    </div> 
                    <div class="uk-form-row">
                        <div class="uk-form-controls">
                            <label class="uk-form-label">
                            <input type="checkbox" type="text" name="is_closed">
                            <span data-lang>This is close status</span> </label>
                        </div>
                    </div> 
                    <div class="uk-modal-footer">
                        <button class="uk-button uk-button-primary" data-lang>Save</button>
                        <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                    </div>
                
                </form>
            </div>
        </div>
        
        <?php /*** Modal Delete */ ?>
        <div id="modal-delete-status" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-small">  <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header">  <h3 data-lang>Delete status</h3>  </div>
                <form action="<?=URL_BASE?>ajax.php?f=supplies/statuses/postDelete" method="post" data-trigger="status-deleted">
                    <p><span data-lang>Are you sure you want to delete status</span> #<b name="id"></b> ?</p>
                    <input type="hidden" name="id">
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                        <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php /*** Modal EDIT */ ?>
         <div id="modal-edit-status" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=supplies/statuses/getStatus" data-hide-on-submit>
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3 data-lang>Edit status</h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=supplies/statuses/postEdit" data-trigger="status-updated">
                    <input type="hidden" name="id">
                    <div class="uk-form-row">
                        <label class="uk-form-label">fa-Icon <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <select class="uk-width-1-1 select2" data-get="<?=URL_BASE?>ajax.php?f=getIcons" style="width:100%" name="icon"
                                data-templateResult='<i class="{{id}}"></i> {{text}}</span>'
                                data-templateSelection='<i class="{{id}}"></i> {{text}}</span>'
                            ></select>
                        </div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="name"></div>
                    </div>
                     <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Color</span> </label>
                        <div class="uk-form-controls">
                            <input type="color" name="color" placeholder="#000000">
                        </div>
                    </div> 
                    <div class="uk-form-row">
                        <div class="uk-form-controls">
                            <label class="uk-form-label"><input type="checkbox" type="text" name="is_closed"><span data-lang>This is close status</span></label>
                        </div>
                    </div> 
                    <div class="uk-modal-footer">
                        <button class="uk-button uk-button-primary" data-lang>Save</button>
                        <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                    </div>
                
                </form>
            </div>
        </div>
        
        </div>
        <?php include '../snipps/foot.php'; ?>
        <script src="<?=$_ASSETS['application.js']?>"></script>

    </body>
</html>