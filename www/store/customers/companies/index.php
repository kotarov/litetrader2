<?php include '../../snipps/init.php'; ?>
<?php 
    $cities_opts = '';
    foreach(parse_ini_file(INI_DIR.'cities-bg.ini',true) AS $region=>$cc){
        $cities_opts .= '<optgroup label="'.$region.'">';
        foreach($cc AS $city=>$r) $cities_opts .= '<option value="'.$city.'"data-region="'.$region.'">'.$city.'</option>';
        $cities_opts .= '</optgroup>';
    } 
?>
<!DOCTYPE html>
<html class="uk-height-1-1">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Companies of Customers</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.form.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.form.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        
        <link href="<?=$_ASSETS['picedit.css']?>" rel="stylesheet"> <script src="<?=$_ASSETS['picedit.js']?>"></script>
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.buttons.js']?>"></script>
        
        <script src="<?=$_ASSETS['highlight.js']?>"></script>
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
        
        <link  href="<?=$_ASSETS['select2.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['select2.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
    </head>
    
    <body id="page-customers"> 
        <?php include '../../snipps/head.php'; ?>
    
        <h2 class="page-header" data-lang="Companies of Customers"></h2>
        <div class="uk-container">
        
        <table id="companies" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-add="company-added"
            data-trigger-update="company-updated"
            data-trigger-delete="company-deleted"
        ></table>
        
        <script>$('#companies').DataTable({
            dom: '<"uk-float-right uk-margin-left"B><"uk-float-right"f>lrtip',
        	ajax: "<?=URL_BASE?>ajax.php?f=customers/companies/getCompanies",
        	stateSave: true,
        	order: [[ 0, "asc" ]],
            columns: [
                { data:"id", title: (lang['Id']||'Id'), width:"1em", class:"uk-text-center id" },
                {data:"logo", sortable:false, title:(lang["Logo"]||"Logo"), render:function(d,t,r){
                return '<a href="#modal-company-logo" data-populate=\'{"id":"'+r.id+'","logo":"image.php/'+r.id+'/'+r.logo_date+'"}\' data-uk-modal >'
                    +'<img style="max-width:40px;max-height:30px" src="image.php/'+r.id+'/'+r.logo_date+'" ></a>';
            }
        },
                { data:"name", title: (lang['Name']||'Name') },
                { data:"email", title: (lang['Email']||'Email') },
                { data:"phone", title: (lang['Phone']||'Phone') },
                { data:"mrp", title: (lang['MRP']||'MRP') },
                { data:"ein", title: (lang['EIN']||'EIN') },
                { data:"address", title: (lang['Address']||'Address') },
                { data:"actions", title:"", width:"1em", orderable:false, searchable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
        			render: function(d,t,r){
                        var badge_empl = r.nb_employees > 0 ? '<sup class="uk-badge uk-badge-success" style="">'+r.nb_employees+'</sup> ' : '';
        			    return ''
        			+'<a class="uk-icon-edit"  href="#modal-edit-company"       data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Edit"></a>'
        			+'<a class="uk-icon-users" href="#modal-company-employees"  data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Companies">'+badge_empl+'</a>'
        			+'<a class="uk-icon-trash" href="#modal-delete-company"     data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Delete"></a>';
        		},  },
            ],
            buttons: [{	text:(lang['New']||"New"), className:"uk-button uk-button-primary", 
                init: function(dt, node, config) {  node.attr("data-uk-modal",true).attr("href","#modal-new-company");  }
        	}],
        	fnDrawCallback:function(settings){ $("tbody",this[0]).unhighlight().highlight( this.api().search().split(" ") ); }
        });</script>
        
        
        
        
        <?php /*** Modal NEW */ ?>
         <div id="modal-new-company" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3 data-lang>New company</h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=customers/companies/postNew" data-trigger="company-added">
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" placeholder="Full company name*" title="Company name" type="text" name="name" data-lang>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Datas</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" placeholder="MRP*" title="MRP" type="text" name="mrp" data-lang>
                            <input class="uk-width-small-1-2" placeholder="(EIN)" title="EIN" type="text" name="ein">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Contacts</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" placeholder="Email*" title="Email" type="text" name="email" data-lng>
                            <input class="uk-width-small-1-2" placeholder="(Phone)" title="Phone" type="text" name="phone" data-lang>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Socials</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" placeholder="(Skype)" title="Skype" type="text" name="skype">
                            <input class="uk-width-small-1-3" placeholder="(Facebook)" title="Facebook" type="text" name="facebook">
                            <input class="uk-width-small-1-3" placeholder="(Twitter)" title="Twitter" type="text" name="twitter">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Address</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" placeholder="Country" title="Country" type="text" name="country" data-lang value="България">
                            <span class="uk-width-small-1-2" style="padding:0">
                                <select name="city" style="width:100%" class="select2" data-lang
                                    title="City"
                                ><?=$cities_opts?></select>
                            </span>
                            <?php /*<input class="uk-width-small-1-2" placeholder="City" title="City" type="text" name="city" data-lang>*/?>                        
                            <input type="text" class="uk-width-1-1" placeholder="Address" title="Address" name="address" data-lang>
                        </div>
                    </div>
            
                    <div class="uk-modal-footer">
                        <button class="uk-button uk-button-primary" data-lang>Save</button>
                        <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                    </div>
                
                </form>
            </div>
        </div>
        
        
        <?php /*** Modal EDIT */ ?>
         <div id="modal-edit-company" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=customers/companies/getCompany" data-hide-on-submit>
            <div class="uk-modal-dialog">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Edit company</span> #<span class="uk-text-muted" name="id"></span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=customers/companies/postEdit" data-trigger="company-updated">
                    
                    <input type="hidden" name="id">
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" placeholder="Full company name*" title="Company name" type="text" name="name">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Datas</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" placeholder="MRP*" title="MRP" type="text" name="mrp">
                            <input class="uk-width-small-1-2" placeholder="(EIN)" title="EIN" type="text" name="ein">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Contacts</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" placeholder="Email*" title="Email" type="text" name="email">
                            <input class="uk-width-small-1-2" placeholder="(Phone)" title="Phone" type="text" name="phone">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Socials</span></label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" placeholder="(Skype)" title="Skype" type="text" name="skype">
                            <input class="uk-width-small-1-3" placeholder="(Facebook)" title="Facebook" type="text" name="facebook">
                            <input class="uk-width-small-1-3" placeholder="(Twitter)" title="Twitter" type="text" name="twitter">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Address</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" placeholder="Country" title="Country" type="text" name="country">
                            <span class="uk-width-small-1-2" style="padding:0">
                                <select name="city" style="width:100%" class="select2" data-lang
                                    title="City"
                                ><?=$cities_opts?></select>
                            </span>
                            <?php /*<input class="uk-width-small-1-2" placeholder="City" title="City" type="text" name="city"> */?>                         
                            <input type="text" class="uk-width-1-1" placeholder="Address" title="Address" name="address">
                        </div>
                    </div>
            
                    <div class="uk-modal-footer">
                        <button class="uk-button uk-button-primary" data-lang>Save</button>
                        <button class="uk-button uk-modal-close" data-lang>Cancel</button>
                    </div>

                </form>
            </div>
        </div>

        
        
        
        <?php /*** Modal Company EMPLOEES List */ ?>
        <div id="modal-company-employees" class="uk-modal">
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Emploees of company</span> #<span name="id"></span></h3> </div>
                
                <table id="list-company-employees" cellspacing="0" width="100%" 
                    data-trigger-reload="employees-changed" 
                    data-get="<?=URL_BASE?>ajax.php?f=customers/companies_employees/getList" 
                    class="uk-table uk-table-hover uk-table-striped uk-table-condensed" 
                ></table>
                <script>$("#list-company-employees").DataTable({
                    dom: 't',
                    paginate: false,
                    order: [[ 2, "asc" ]],
                    columns: [
                        { data:"is_active", title:(lang['Active']||'Active'), orderable:false, width:"1em", class:"uk-text-center", render: function(d,t,r){
                                var icon = d ? "uk-icon-user" : "uk-icon-user-times uk-text-muted";
                			    return '<a href="<?=URL_BASE?>ajax.php?f=customers/postToggle" data-toggle="is_active" data-post=\'{"id":"'+r.id+'"}\' data-trigger="employees-changed" class="'+icon+'"></a><span class="uk-hidden">'+d+"</span>";    
                        }   },
                        { data:"photo", sortable:false, title: (lang["Photo"]  ||"Photo"), render:function(d,t,r){ return '<img style="width:30px" class="uk-border-circle" src="../image.php/'+r.id+'/'+r.photo_date+'">'; } },
                        { data:"id", title: (lang['Id']||'Id'), class:"uk-text-center id" },
                        { data:"name", title: (lang['Name']||'Name')  },
                        { data:"phone", title: (lang['Phone']||'Phone') },
                        { data:"email", title: (lang['Email']||'Email') },
                        { data:"actions", title:"", width:"1em", orderable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
            			render:function(d,t,r){ return ''
            			    +'<a class="uk-icon-times uk-icon-justify" href="#modal-remove-employee-from-company" data-uk-modal=\'{"modal":false}\' data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="Remove"></a>';
            			}}
                    ]
                });</script>
                <form action="<?=URL_BASE?>ajax.php?f=customers/companies_employees/postAddEmployee" data-trigger="employees-changed, company-updated">
                    <div class="uk-text-right uk-margin-top">
                        <input type="hidden" name="id">
                        <select class="select2"  name="id_employee" style="width:300px"
                            data-ajax--url="<?=URL_BASE?>ajax.php?f=customers/companies_employees/searchPartner" 
                            data-templateResult='{{id}}. <img src="../image.php/{{id}}" width="30" class="uk-border-circle"> {{text}} <br><small><i class="uk-icon-phone"></i> {{phone}} | <i class="uk-icon-envelope"></i> {{email}}</small>' 
                            data-placeholder="+ Search ..."
                            type="submit" 
                        ><option></option></select>
                        
                        <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                    </div>
                </form>
            
            </div>
        </div>
        
        <?php /*** Modal remove emploee from company */ ?>
        <div id="modal-remove-employee-from-company" class="uk-modal" data-hide-on-submit="true">
            <div class="uk-modal-dialog uk-modal-dialog-small"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3 data-lang>Remove employee from company</h3> </div>
                <form action="<?=URL_BASE?>ajax.php?f=customers/companies_employees/postRemoveEmployee" method="post" data-trigger="employees-changed,company-updated">
                    <p><span data-lang>Remove employee</span> #<span name="id"></span> <span data-lang>from</span> <span data-lang>company</span> ?</p>
                    <input type="hidden" name="id">
                    <input type="hidden" name="id_parent">
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger"data-lang>Delete</button>
                        <button type="button" class="uk-modal-close uk-button" data-lang>Cancel</button>
                    </div>
                </form>
            </div> 
        </div>
        
        
        
        <?php /*** Modal Delete */ ?>
        <div id="modal-delete-company" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-small"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header">  <h3 data-lang>Delete company</h3>  </div>
                <form action="<?=URL_BASE?>ajax.php?f=customers/companies/postDelete" method="post" data-trigger="company-deleted">
                    <p><span data-lang>Are you sure you want to delete this company</span> #<span name="id"></span> ?</p>
                    <input type="hidden" name="id">
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                        <button type="button" class="uk-modal-close uk-button" data-lang>Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        
        
          <?php /*** Modal image */?>
            <?php $s = parse_ini_file(INI_DIR.'customers/images.ini',true); $s=$s['company'];?>
            
            <div id="modal-company-logo" class="uk-modal" >
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Photo of partner</span> #<span name="id"></span></h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=customers/companies/postImage" data-trigger="company-updated,company-changed-image">
                        <div class="uk-grid">
                            <div class="uk-width-small-2-3">
                                <div> <span data-lang>Full size</span>  <b name="size"></b> (<?=$s['image']['width'].' x '.$s['image']['height'];?>):</div>
                                <img name="logo" class="uk-thumbnail" src="image.php/1/image/">
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="file" id="select-company-image" name="images[]" class="uk-hidden" onchange="if($(this).val()) $(this).closest('form').submit()">
                        <br>
                        <button type="submit" onclick="$('#select-company-image').val('')" class="uk-button uk-float-left uk-text-danger"><i class="uk-icon-trash"></i> <span data-lang>Remove</span></button>
                        <div class="uk-text-right">
                            <span class="upload-progress" data-lang>Upload:</span>
                            <a href="#modal-tune-upload-logo" data-uk-modal='{modal:false}' onclick="$('#modal-tune-upload-logo [name=id]').val($('#modal-company-logo [name=id]').val());" class="uk-button uk-button-primary" ><i class="uk-icon-object-group"></i> <span data-lang>Tune upload</span></a>
                            <button type="button" class="uk-button uk-button-success" onclick="$('#select-company-image').click()" data-lang>Quick upload</span></button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $(document).on("company-changed-image",function(e,ret){
                    $("#modal-company-logo [name=logo]").attr("src","image.php/"+ret.id+"/"+ret.logo_date);
                });
            </script>

            
            <?php /*** Modal Tune Upload IMAGE */ ?>
             <div id="modal-tune-upload-logo" class="uk-modal no-ajax" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Tune Upload image</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=customers/companies/postImage" data-trigger="company-changed,company-changed-image" method="post">
                        <input type="hidden" name="id_parent">
                        <input type="hidden" name="picEdit" value="1">
                        
                        <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Image</label>
                                <div class="uk-form-controls"> <input type="file" name="images[]" class="picEdit"> </div>
                        </div>
                        <br>

                        <div class="uk-form-controls"> 
                            <div class="uk-float-left">
                                <button type="button" class="uk-button uk-button-success" onclick='$("#modal-tune-upload-logo").find(".ico-picedit-picture").click();' ><i class="uk-icon-file-image-o"></i> <span data-lang>Load</button>
                                <button type="button" class="uk-button uk-button-success" onclick='$("#modal-tune-upload-logo").find(".ico-picedit-camera").click();' ><i class="uk-icon-camera"></i> <span data-lang>Photo</button>
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
                $('#modal-tune-upload-logo .picEdit').picEdit({
                    formSubmitted: function(res){
                        var result = $.parseJSON(res.response);
                        $(document).trigger("company-updated",result);
                        $(document).trigger("company-changed-image",result);
                        UIkit.modal( $("#modal-tune-upload-logo") ).hide();
                    }                 
                });
            </script>
        
        
        <script src="<?=$_ASSETS['application.js']?>"></script>
        </div>
        <?php include '../../snipps/foot.php'; ?>
    </body>
    
</html>