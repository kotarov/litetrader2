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
        
        <link  href="<?=$_ASSETS['uikit.autocomplete.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.datepicker.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.datepicker.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.timepicker.js']?>"></script>
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.buttons.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.sum.js']?>"></script>
        
        <script src="<?=$_ASSETS['highlight.js']?>"></script>
        
        <link  href="<?=$_ASSETS['select2.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['select2.js']?>"></script>
        
        __PLUGIN_PICEDIT__
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
        <script src="<?=$_ASSETS['chart.sparkline.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
    </head>
    
    <body id="page-__MODULE__"> 
        <?php include '../snipps/head.php'; ?>
    
        <h2 class="page-header"><span data-lang="__TITLE__"></span> <span class="uk-margin-left page-sparkline" data-table="customers"></span></h2>
        <div class="uk-container">
    
        <table id="partners" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-add="partner-added"
            data-trigger-update="partner-updated"
            data-trigger-delete="partner-deleted"
        ></table>

        <script> $('#partners').dataTable({
            dom: '<"uk-float-right uk-margin-left"B><"uk-float-right"f>lrtip',
        	ajax: "<?=URL_BASE?>ajax.php?f=__MODULE__/getPartners",
        	stateSave: true,
        	order: [[ __DT_DEF_ORDER__, "asc" ]],
            columns: [
                __DT_ACTIVE__
                __DT_ADVERTISE__
                { data:"id",     title: (lang['Id']     ||'Id'), width:"1em", class:"uk-text-center id"},
                __DT_PHOTO__
                { data:"name",   title: (lang['Name']   ||'Name') },
                __DT_PHONE__
                { data:"email",  title: (lang['Email']  ||'Email') },
                __DT_ADDRESS__
                __DT_COMPANY__
                { data:"actions",title:"", width:"1em", orderable:false, searchable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
        			render: function(d,t,r){
        			    __DT_ACTION_CART__
        			    return '<span>'+btn_cart
        			+'<a href="#modal-edit-partner" class="uk-icon-edit uk-icon-justify" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Edit"></a>'
        			+'<a href="#modal-delete-partner" class="uk-icon-trash uk-icon-justify " data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'","customer":"'+r.name+'"}\' title="Delete"></a>'
        			+'</span>';
        			},
        		},
            ],
            buttons: [{	text:(lang["New"]||"New"), className:"uk-button uk-button-primary",
    			init: function(dt, node, config) {  node.attr("data-uk-modal",true).attr("href","#modal-new-partner");  }
        	}],
        	fnDrawCallback:function(settings){ $("tbody",this[0]).unhighlight().highlight( this.api().search().split(" ") ); }
        }); </script>
        
        
        
        
        <?php /*** Modal NEW */ ?>
         <div id="modal-new-partner" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3 data-lang>New</h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/postNew" data-trigger="partner-added">
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span  data-lang>Name </span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" type="text" placeholder="Name*" title="Name" name="name">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Surname)" title="Surname" name="surname">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Family)" title="Family" name="family">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Email <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="email" name="email"></div>
                    </div>
                    __FORM_PHONE__
                    __FORM_OTHER_PHONES__
                    __FORM_SOCIALS__
                    __FORM_ADDRESS__
                    __FORM_COMPANY__                    
                    __FORM_SITE__
                    __FORM_BIRTHDAY__
                    __FORM_DATETIME__
                    __FORM_SOMEDATE__
                    <div class="uk-modal-footer">
                        <button class="uk-button uk-button-primary" data-lang>Save</button>
                        <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                    </div>
                
                </form>
            </div>
        </div>
        
        
        <?php /*** Modal EDIT */ ?>
         <div id="modal-edit-partner" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/getPartner" data-hide-on-submit>
            <div class="uk-modal-dialog">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Edit</span> #<span class="uk-text-muted" name="id"></span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/postEdit" data-trigger="partner-updated">
                    <input type="hidden" name="id">
                     <div class="uk-form-row">
                        <label class="uk-form-label"><span  data-lang>Name </span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" type="text" placeholder="Name*" title="Name" name="name">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Surname)" title="Surname" name="surname">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Family)" title="Family" name="family">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Email <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="email" name="email"></div>
                    </div>
                    __FORM_PHONE__
                    __FORM_OTHER_PHONES__
                    __FORM_SOCIALS__
                    __FORM_ADDRESS__
                    __FORM_COMPANY__                    
                    __FORM_SITE__
                    __FORM_BIRTHDAY__
                    __FORM_DATETIME__
                    __FORM_SOMEDATE__
                     <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Password</label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-width-1-1" placeholder="•••••" name="password">
                            <p class="uk-form-help-block" data-lang>Leave blank to keep the old</p>
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
        <div id="modal-delete-partner" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-small">  <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header">  <h3><span data-lang>Delete partner</span> #<span name="id"></span></h3>  </div>
                <form action="<?=URL_BASE?>ajax.php?f=__MODULE__/postDelete" method="post" data-trigger="partner-deleted">
                    <p><span data-lang>Are you sure you want to delete</span> <br>"<b name="customer"></b>" ?</p>
                    <input type="hidden" name="id">
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                        <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    
        __MODAL_PHOTO__
    
        <script src="<?=$_ASSETS['application.js']?>"></script>
        </div>
        <?php include '../snipps/foot.php'; ?>
    </body>
    
</html>