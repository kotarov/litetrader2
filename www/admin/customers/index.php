<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Customers</title>
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
        
        <link href="<?=$_ASSETS['picedit.css']?>" rel="stylesheet"> <script src="<?=$_ASSETS['picedit.js']?>"></script>
        
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
        <script src="<?=$_ASSETS['chart.sparkline.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
    </head>
    
    <body id="page-customers"> 
        <?php include '../snipps/head.php'; ?>
    
        <h2 class="page-header"><span data-lang="Customers"></span> <span class="uk-margin-left page-sparkline" data-table="customers"></span></h2>
        <div class="uk-container">
    
        <table id="partners" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-add="partner-added"
            data-trigger-update="partner-updated"
            data-trigger-delete="partner-deleted"
        ></table>

        <script> $('#partners').dataTable({
            dom: '<"uk-float-right uk-margin-left"B><"uk-float-right"f>lrtip',
        	ajax: "<?=URL_BASE?>ajax.php?f=customers/getPartners",
        	stateSave: true,
        	order: [[ 2, "asc" ]],
            columns: [
                { data:"is_active", title: (lang['Active']||'Active'), width:"1em", class:"uk-text-center", render:function(d,t,r){
        			var icon = d ? "uk-icon-user" : "uk-icon-user-times uk-text-muted";
        			return '<a href="<?=URL_BASE?>ajax.php?f=customers/postToggle" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_active" data-trigger="partner-updated" class="'+icon+'"></a><span class="uk-hidden">'+d+"</span>";
        		}},
                { data:"is_advertise", title: (lang['Advertise']||'Advertise'), width:"1em", class:"uk-text-center", render:function(d,t,r){
        			var icon = (d==1) ? "uk-icon-envelope uk-text-danger" : "uk-icon-envelope-o uk-text-muted";
        			return '<a href="<?=URL_BASE?>ajax.php?f=customers/postToggle" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_advertise" data-trigger="partner-updated" class="'+icon+'"></a><span class="uk-hidden">'+d+"</span>";
        		}},
                { data:"id",     title: (lang['Id']     ||'Id'), width:"1em", class:"uk-text-center id"},
                { data:"photo", sortable:false, title: (lang['Photo']  ||'Photo'), render:function(d,t,r){
    return '<a href="#modal-image-partner" '
        +' data-uk-modal data-populate=\'{"id":"'+r.id+'","photo":"image.php/'+r.id+'/'+r.photo_date+'"}\'>'
    +'<img style="width:30px" class="uk-border-circle" src="image.php/'+r.id+'/'+r.photo_date+'"></a>';
} },
                { data:"name",   title: (lang['Name']   ||'Name') },
                { data:"phone",  title: (lang['Phone']  ||'Phone') },
                { data:"email",  title: (lang['Email']  ||'Email') },
                { data:"address", title: (lang['Address']||'Address') },
                { data:"company",title: (lang['Company']||'Company'), render: function(d,t,r){
        if(d) return d.replace(/\,/g,", "); else return d;
            }},
                { data:"actions",title:"", width:"1em", orderable:false, searchable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
        			render: function(d,t,r){
        			    var btn_cart = "";
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
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=customers/postNew" data-trigger="partner-added">
                    
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
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Phone</label>
                        <div class="uk-form-controls"><input class="uk-width-small-1-2" type="text" name="phone"></div>
                    </div>
                    <div class="uk-form-row uk-margin-bottom">
                        <label class="uk-form-label" data-lang>Other phones</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Work)" title="Work" name="work">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Mobile)" title="Mobile" name="mobile">
                            <input class="uk-width-small-1-3" type="text" placeholder="(SIP)" title="SIP" name="sip">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Socials</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Skype)" title="Skype" name="skype">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Facebook)" title="Facebook" name="facebook">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Twitter)" title="Twitter" name="twitter">
                        </div>
                    </div>
                    <?php if(!isset($cities_opts)){
    $cities_opts = '';
    foreach(parse_ini_file(INI_DIR.'cities-bg.ini',true) AS $region=>$cc){
        $cities_opts .= '<optgroup label="'.$region.'">';
        foreach($cc AS $city=>$r) $cities_opts .= '<option value="'.$city.'"data-region="'.$region.'">'.$city.'</option>';
        $cities_opts .= '</optgroup>';
    } 
}?>
<div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Address</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" type="text" placeholder="Country" title="Country" name="country" value="България">
                            <span class="uk-width-small-1-2" style="padding:0">
                                <select name="city" style="width:100%" class="select2" data-lang
                                    title="City"
                                ><?=$cities_opts?></select>
                            </span>
                            
                            <?php /*<input class="uk-width-small-1-2" type="text" placeholder="City" title="City" name="city"> */?>
                            <input class="uk-width-small-1-1" type="text" placeholder="Address" title="Address" name="address">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Company</label>
                        <div class="uk-form-controls">
                            <select class="select2 uk-width-1-1" style="width:100%" 
                                data-allow-clear="true" 
                                data-get="<?=URL_BASE?>ajax.php?f=customers/companies/getCompanies" 
                                multiple name="id_company[]"
                                data-templateResult="<image style='max-width:30px' src='companies/image.php/{{id}}/{{logo_date}}'>  {{name}}" 
                                data-templateSelection="<image style='max-width:20px' src='companies/image.php/{{id}}/{{logo_date}}'>  {{name}}" 
                            ></select>
                        </div>
                    </div>                    
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>Site</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="site"></div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>Birthday</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-small-1-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="birthday">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>DateTime</span></label>
                        <div class="uk-form-controls">
                            <div class="uk-width-small-1-2 uk-grid uk-grid-collapse" style="margin-left:0">
                                <input class="uk-width-small-2-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="datetime_date">
                                <div class="uk-width-small-1-3">
                                    <input class="uk-width-1-1" type="text" placeholder="__:__" data-uk-timepicker="{format:'24h'}" name="datetime_time">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>SomeDate</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-small-1-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="somedate">
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
         <div id="modal-edit-partner" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=customers/getPartner" data-hide-on-submit>
            <div class="uk-modal-dialog">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Edit</span> #<span class="uk-text-muted" name="id"></span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=customers/postEdit" data-trigger="partner-updated">
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
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Phone</label>
                        <div class="uk-form-controls"><input class="uk-width-small-1-2" type="text" name="phone"></div>
                    </div>
                    <div class="uk-form-row uk-margin-bottom">
                        <label class="uk-form-label" data-lang>Other phones</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Work)" title="Work" name="work">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Mobile)" title="Mobile" name="mobile">
                            <input class="uk-width-small-1-3" type="text" placeholder="(SIP)" title="SIP" name="sip">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Socials</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Skype)" title="Skype" name="skype">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Facebook)" title="Facebook" name="facebook">
                            <input class="uk-width-small-1-3" type="text" placeholder="(Twitter)" title="Twitter" name="twitter">
                        </div>
                    </div>
                    <?php if(!isset($cities_opts)){
    $cities_opts = '';
    foreach(parse_ini_file(INI_DIR.'cities-bg.ini',true) AS $region=>$cc){
        $cities_opts .= '<optgroup label="'.$region.'">';
        foreach($cc AS $city=>$r) $cities_opts .= '<option value="'.$city.'"data-region="'.$region.'">'.$city.'</option>';
        $cities_opts .= '</optgroup>';
    } 
}?>
<div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Address</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" type="text" placeholder="Country" title="Country" name="country" value="България">
                            <span class="uk-width-small-1-2" style="padding:0">
                                <select name="city" style="width:100%" class="select2" data-lang
                                    title="City"
                                ><?=$cities_opts?></select>
                            </span>
                            
                            <?php /*<input class="uk-width-small-1-2" type="text" placeholder="City" title="City" name="city"> */?>
                            <input class="uk-width-small-1-1" type="text" placeholder="Address" title="Address" name="address">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Company</label>
                        <div class="uk-form-controls">
                            <select class="select2 uk-width-1-1" style="width:100%" 
                                data-allow-clear="true" 
                                data-get="<?=URL_BASE?>ajax.php?f=customers/companies/getCompanies" 
                                multiple name="id_company[]"
                                data-templateResult="<image style='max-width:30px' src='companies/image.php/{{id}}/{{logo_date}}'>  {{name}}" 
                                data-templateSelection="<image style='max-width:20px' src='companies/image.php/{{id}}/{{logo_date}}'>  {{name}}" 
                            ></select>
                        </div>
                    </div>                    
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>Site</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="site"></div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>Birthday</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-small-1-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="birthday">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>DateTime</span></label>
                        <div class="uk-form-controls">
                            <div class="uk-width-small-1-2 uk-grid uk-grid-collapse" style="margin-left:0">
                                <input class="uk-width-small-2-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="datetime_date">
                                <div class="uk-width-small-1-3">
                                    <input class="uk-width-1-1" type="text" placeholder="__:__" data-uk-timepicker="{format:'24h'}" name="datetime_time">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" ><span data-lang>SomeDate</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-small-1-3" type="text" placeholder="__.__.____" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="somedate">
                        </div>
                    </div>
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
                <form action="<?=URL_BASE?>ajax.php?f=customers/postDelete" method="post" data-trigger="partner-deleted">
                    <p><span data-lang>Are you sure you want to delete</span> <br>"<b name="customer"></b>" ?</p>
                    <input type="hidden" name="id">
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                        <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    
          <?php /*** Modal image */?>
            <?php $s = parse_ini_file(INI_DIR.'customers/images.ini',true); $s=$s['profile'];?>
            
            <div id="modal-image-partner" class="uk-modal" >
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Photo of partner</span> #<span name="id"></span></h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=customers/postImage" data-trigger="partner-updated,partner-changed-image">
                        <div class="uk-grid">
                            <div class="uk-width-small-2-3">
                                <div> <span data-lang>Full size</span>  <b name="size"></b> (<?=$s['image']['width'].' x '.$s['image']['height'];?>):</div>
                                <img name="photo" class="uk-thumbnail" src="image.php/1/image/">
                                <img name="photo" class="uk-thumbnail uk-border-circle" src="image.php/1/image/">
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="file" id="select-partner-image" name="images[]" class="uk-hidden" onchange="if($(this).val()) $(this).closest('form').submit()">
                        <br>
                        <button type="submit" onclick="$('#select-partner-image').val('')" class="uk-button uk-float-left uk-text-danger"><i class="uk-icon-trash"></i> <span data-lang>Remove</span></button>
                        <div class="uk-text-right">
                            <span class="upload-progress" data-lang>Upload:</span>
                            <a href="#modal-tune-upload-image" data-uk-modal='{modal:false}' onclick="$('#modal-tune-upload-image [name=id]').val($('#form-product-upload-image [name=id]').val());" class="uk-button uk-button-primary" ><i class="uk-icon-object-group"></i> <span data-lang>Tune upload</span></a>
                            <button type="button" class="uk-button uk-button-success" onclick="$('#select-partner-image').click()" data-lang>Quick upload</span></button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $(document).on("partner-changed-image",function(e,ret){
                    $("#modal-image-partner [name=photo]").attr("src","image.php/"+ret.id+"/"+ret.photo_date);
                });
            </script>

            
            <?php /*** Modal Tune Upload IMAGE */ ?>
             <div id="modal-tune-upload-image" class="uk-modal no-ajax" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Tune Upload image</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=customers/postImage" data-trigger="partner-changed,partner-changed-image" method="post">
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
                        $(document).trigger("partner-updated",result);
                        $(document).trigger("partner-changed-image",result);
                        UIkit.modal( $("#modal-tune-upload-image") ).hide();
                    }                 
                });
            </script>
    
        <script src="<?=$_ASSETS['application.js']?>"></script>
        </div>
        <?php include '../snipps/foot.php'; ?>
    </body>
    
</html>