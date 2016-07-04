<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Orders</title>
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
        <script src="<?=$_ASSETS['dataTables.sum.js']?>"></script>
        
        <script src="<?=$_ASSETS['highlight.js']?>"></script>
        
        <link  href="<?=$_ASSETS['select2.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['select2.js']?>"></script>
        
        <script src="<?=$_ASSETS['chart.sparkline.js']?>"></script>
        <script src="<?=URL_BASE.$_ASSETS['lang.js']?>"></script>
        
        <link  href="<?=$_ASSETS['application.css']?>" rel="stylesheet">
        <link  href="<?=URL_BASE.$_ASSETS['theme.css']?>" rel="stylesheet">
        <style>
            .uk-form-help-block {color:#aaa;}
        </style>
    </head>
    
    <body id="page-customers"> 
        <?php include '../snipps/head.php'; ?>
            
        <h2 class="page-header"><spn data-lang>Orders of Customers</span><span class="uk-margin-left page-sparkline" data-table="customers_orders"></span></h2>
        <div class="uk-container">
        
        <table id="orders" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%"
            data-trigger-add="order-added"
            data-trigger-update="order-updated"
            data-trigger-delete="order-deleted"
        ><tfoot><tr> <th></th> <th></th> <th></th> <th></th> <td colspan="2" class="uk-text-right"><span data-lag>Current page SUM</span>:</td> <th class="sum uk-text-nowrap"></th> <th class="sum_tax"></th> <th class="sum_delivery"></th> </tr></tfoot></table>

        <script> 
            $("#orders").DataTable({
            	dom: '<"uk-float-right uk-margin-left"B><"uk-float-right"f><"uk-float-left"lr> tip',
            	ajax: "<?=URL_BASE?>ajax.php?f=sales/getList",
            	stateSave: true,
            	order: [[ 1, "desc" ]],
            	columns: [
            		{ data:"status", title:(lang["Status"]||"Status"), width:"1em","class":"uk-text-center uk-text-middle actions",render:function(d,t,r){
            		    return '<a href="#modal-change-status" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\' title="'+r.status_name+'"> <i class="'+d+'" style="color:'+r.color+'"></i>'
            		        +(r[9]==1?' <small class="uk-icon-lock uk-text-small"></small> ':' ')+'</a><i class="uk-hidden">'+r.status_name+'</i>';
            		}},
            		{ data:"id", title:(lang["Id"]||"Id"), width:"2em","class":"uk-text-center uk-text-middle id" },
            		{ data:"date_add", title:(lang["Date"]||"Date"), "class":"uk-text-center uk-text-middle", render:function(d,t,r){
            		    var date = d;//d?(new Date(d * 1000).toLocaleDateString()):'-';
            		    return date!='-'?date:'-';
            		}},
            		{ data:"partner", title:(lang["Customers"]||"Customers"), render:function(d,t,r){return (r.id_partner>0?d:d+' <small class="uk-badge uk-badge-warning">Unregistered</small> ')} },
            		{ data:"company", title:(lang["Company"]||"Company"),render:function(d,t,r){
    var un = r.id_company > 0 ? '' : ' <small class="uk-badge uk-badge-warning">Unregistered</small> ';
    return (d?d+un:'<i class="uk-icon-home"></i> Home');
}},
            		{ data:"address", title:(lang["Address"]||"Address"), render:function(d,t,r){ 
            		    return r.city + ', ' + r.country + ',<br> ' + r.address;
            		}  },
            		
            		{ data:"total", title:(lang["Total"]||"Total"),"class":"uk-text-right sum actions", render:function(d,t,r){
            		    return '<a href="#modal-cart-order" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\'>'+(d?parseFloat(d).toFixed(2):'<i class="uk-icon-cart-plus uk-text-success"></i>')+ '</a>&nbsp;&nbsp;';
            		} },
            		{ data: "tax_price", "class":"uk-text-center sum_tax", title: (lang["Tax"]||"Tax"), render:function(d,t,r){
            		    return parseFloat(d).toFixed(2)+' <br><sup>'+r.tax+'</sup>';
            		}},
            		{ data: "delivery_price", "class":"uk-text-center sum_delivery", title:(lang["Delivery"]||"Delivery"),render:function(d,t,r){
            		    if(!d) d=0;
            		    return parseFloat(d).toFixed(2)+' <br><sup>'+r.delivery_method+'</sup>';
            		}},
            		
            		
            		{ data: "invoice", "class":"actions", title:(lang["Invoice"]||"Invoice")},
            		
            	    { data:"actions", title:"", width:"1em", orderable:false, searchable:false, "class":"uk-text-center uk-text-middle uk-text-nowrap actions",
            		    render: function(d,t,r){ return ''
            			+'<a href="#modal-edit-order" data-uk-modal class="uk-icon-edit uk-icon-justify" data-get="id='+d+'" data-populate=\'{"id":"'+d+'","partner-photo":"../customers/image.php/'+r.id_partner+'","company-logo":"../customers/companies/image.php/'+r.id_company+'"}\' title="Edit"></a>'
            			+'<a href="#modal-delete-order" data-uk-modal class="uk-icon-trash uk-icon-justify" data-get="id='+d+'" data-populate=\'{"id":"'+d+'"}\' title="Delete"></a>';
            		}    }
            	],
            	buttons: [{	text:(lang["New"]||"New"), className:"uk-button uk-button-primary",
            		init: function(dt, node, config){ node.attr("data-uk-modal",true).attr("href","#modal-new-order"); }
            	}],
                fnDrawCallback:function(settings){ $("tbody",this[0]).unhighlight().highlight( this.api().search().split(" ") ); 
                    var api = this.api(); 
                    $( api.table().footer() ).find(".sum").html(
                        parseFloat(api.column( ".sum", {page:'current'} ).data().sum()).toFixed(2)+' лв'
                    );
                    $( api.table().footer() ).find(".sum_tax").html(
                        parseFloat(api.column( ".sum_tax", {page:'current'} ).data().sum()).toFixed(2)
                    );
                     $( api.table().footer() ).find(".sum_delivery").html(
                        parseFloat(api.column( ".sum_delivery", {page:'current'} ).data().sum()).toFixed(2)
                    );
                }
            });    		
        </script>
        
        
        <?php /*** Modal NEW */ ?>
         <div id="modal-new-order" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-medium"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3 data-lang>New Order</h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=sales/post" data-trigger="order-added">
                    
                    <!-- ********* -->
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span class="uk-badge uk-badge-notification">1</span> <span data-lang>Customers</span> </label>
                        <div class="uk-form-controls">
                            <select class="select2 uk-width-1-1" style="width:100%" 
                                name="id_partner" 
                                data-placeholder="UNREGISTERED" data-lang 
                                data-allow-clear= "true" 
                                data-ajax--url="<?=URL_BASE?>ajax.php?f=sales/searchPartners" 
                                data-templateResult = '<span>
                                        {{id}}. <img src="<?=URL_BASE?>/customers/image.php/{{id}}/{{photo_date}}" width="40" class="uk-border-circle"> {{text}}
                                        <div><small> <i class="uk-icon-phone"></i> {{phone}} | <i class="uk-icon-envelope"></i> {{email}} </small></div>
                                        <div><small><i class="uk-icon-building-o"></i> {{companies}}</small></div>
                                    </span>'
                                data-templateSelection = '<span>{{id}}. <img src="<?=URL_BASE?>/customers/image.php/{{id}}/{{photo_date}}" width="20" class="uk-border-circle"> {{text}} <small>| <i class="uk-icon-envelope"></i> {{email}} | <i class="uk-icon-phone"></i> {{phone}}</small></span>' 
                            ></select>
                        </div>
                    </div>
                    
                        <div class="uk-form-row uk-margin-small-top">
                            <label class="uk-form-label"><span class="uk-badge uk-badge-notification">2</span> <span data-lang>Company</span></label>
                            <div class="uk-form-controls">
                                <select class="select2 uk-width-1-1" style="width:100%" 
                                    name="id_company" 
                                    data-placeholder="UNREGISTERED" data-lang
                                    data-allow-clear="true" 
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerCompanies"
                                    data-depends-on="#modal-new-order [name=id_partner]" 
                                    data-templateSelection = '<i class="{{icon}}"></i> {{text}}'
                                    data-templateResult = '<i class="{{icon}}"></i> {{text}}<br><small><i class="uk-icon-phone"></i> {{phone}} | <i class="uk-icon-envelope"></i> {{email}}</small>'
                                ></select>
                            </div>
                        </div>
                    
                     <!-- ********* -->
                    <hr>
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1"
                                name="partner" 
                                data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]"
                                data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=partner" 
                            ></div>
                            <div class="uk-form-controls">
                                    <label><input type="checkbox" class="toggle-color" name="register-new-partner">  <span data-lang>Create new</span> <span data-lang>Customers</span></label>
                            </div>
                        </div>
                         
                        
                        <div class="uk-form-row uk-margin-top">
                            <label class="uk-form-label" data-lang>Company</label>
                            <div class="uk-form-controls uk-grid">
                                <input class="uk-width-small-2-3" 
                                    name="company" 
                                    title="Company name" data-lang
                                    data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]" 
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=name" 
                                >
                                <input class="uk-width-small-1-3" 
                                    placeholder="EIN" title="EIN" data-lang
                                    name="ein" 
                                    data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]" 
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=ein" 
                                >
                            </div>
                            <div class="uk-form-controls">
                                    <label><input type="checkbox" class="toggle-color" name="register-new-company"> <span data-lang>Crete new</span> <span data-lang>company</span>  </label>
                            </div>
                        </div>
                        <br>
                        
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Contacts</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls uk-grid">
                                <input class="uk-width-small-1-2"
                                    name="email" 
                                    placeholder="Email" title="Email" data-lang 
                                    data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=email" 
                                >
                                <input name="phone" class="uk-width-small-1-2"
                                    placeholder="Phone" title="Phone" data-lang
                                    data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=phone" 
                                >
                            </div>
                        </div>
                        <br>
                        
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Address</label>
                            <div class="uk-form-controls uk-grid">
                                <input type="text"  class="uk-width-small-1-2" data-lang 
                                    name="country"
                                    placeholder="Country" title="Country"
                                    data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=country"  
                                >
                            
                                <input type="text" class="uk-width-small-1-2" data-lang 
                                    name="city"
                                    placeholder="City" title="City"
                                    data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=city" 
                                >
                        
                                <input class="uk-width-small-1-1" data-lang 
                                    name="address"
                                    placeholder="Address" title="Address"
                                    data-depends-on="#modal-new-order [name=id_company],#modal-new-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=address" 
                                >
                            </div>
                        </div>
                        
                       <hr>
                        <?php /***/ ?>
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Tax</label>
                            <div class="uk-form-controls uk-grid">
                                <select type="text"  class="uk-width-small-1-1" data-lang 
                                    name="key_tax"
                                    title="Tax"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/taxes/getList"   
                                >
                                </select>
                            </div>
                        </div>
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Delivery</label>
                            <div class="uk-form-controls uk-grid">
                                <select type="text"  class="uk-width-small-1-1" data-lang 
                                    name="key_delivery_method"
                                    title="Delivery"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/deliveries/getList"  
                                >
                                </select>
                            </div>
                        </div>
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Payment</label>
                            <div class="uk-form-controls uk-grid">
                                <select type="text"  class="uk-width-small-1-1" data-lang 
                                    name="key_payment_method"
                                    title="Payment"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/payments/getList"   
                                >
                                </select>
                            </div>
                        </div>
                         
                        
                    <?php /*    
                    <div class="uk-form-row">
                        <label class="uk-form-label" datal-lang>Create new</label>
                        <div class="uk-form-controls">
                                <label><input type="checkbox" class="toggle-color" name="register-new-partner"> <span data-lang>Customers</span> </label>
                        </div>
                        <div class="uk-form-controls">
                                <label><input type="checkbox" class="toggle-color" name="register-new-company"> <span data-lang>Company</span> </label>
                        </div>
                    </div>
                    */?>
                    <div class="uk-modal-footer uk-margin-top">
                        <button class="uk-button uk-button-primary"><span data-lang>Post</span></button>
                        <button class="uk-button uk-modal-close " data-lang>Cancel</button>
                    </div>
                </form>
                
            </div>
        </div>
        
        
        
        <?php /*** Modal EDIT */ ?>
         <div id="modal-edit-order" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=sales/getOrder" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-medium"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Edit order</span> #<span name="id"></span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=sales/post" data-trigger="order-updated">
                    <input type="hidden" name="id">
                    <input type="hidden" name="original">
   
                    <!-- ********* -->
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Customers</span> </label>
                        <div class="uk-form-controls">
                            
                                    <select class="select2 uk-width-1-1" style="width:100%" 
                                        name="id_partner" 
                                        data-placeholder="UNREGISTERED" data-lang 
                                        data-allow-clear= "true" 
                                        data-ajax--url="<?=URL_BASE?>ajax.php?f=sales/searchPartners" 
                                        data-templateResult = '<span>
                                                {{id}}. <img src="<?=URL_BASE?>/customers/image.php/{{id}}/{{photo_date}}" width="40" class="uk-border-circle"> {{text}}
                                                <div><small> <i class="uk-icon-phone"></i> {{phone}} | <i class="uk-icon-envelope"></i> {{email}} </small></div>
                                                <div><small><i class="uk-icon-building-o"></i> {{companies}}</small></div>
                                            </span>'
                                        data-templateSelection = '<span>{{id}}. <img src="<?=URL_BASE?>/customers/image.php/{{id}}/{{photo_date}}" width="20" class="uk-border-circle"> {{text}}</span>' 
                                    ></select>
                               
                        </div>
                    </div>
                    <div class="uk-form-row uk-margin-small-top">
                            <label class="uk-form-label"><span data-lang>Company</span></label>
                            <div class="uk-form-controls">
                                
                                        <select class="select2 uk-width-1-1" style="width:100%" 
                                            name="id_company" 
                                            data-placeholder="UNREGISTERED" data-lang
                                            data-allow-clear="true" 
                                            data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerCompanies"
                                            data-templateSelection = '<i class="{{icon}}"></i> {{text}}'
                                            data-templateResult = '<i class="{{icon}}"></i> {{text}} <br><small><i class="uk-icon-phone"></i> {{phone}} | <i class="uk-icon-envelope"></i> {{email}}</small>'
                                        ></select>
                                
                                 
                            </div>
                    </div>
                    <div class="uk-form-row">
                            <div class="uk-form-controls">
                                        <button class="uk-button uk-button-success uk-float-right" type="button" 
                                            onclick="$(this).trigger('change');" 
                                            name="id_company_change"
                                            title="Atomaticaly fill down the form" data-lang
                                        ><i class="uk-icon-pencil"></i> <span data-lang>Fill down</span></button>
                            </div>
                    </div>
                       
                       
                    <hr>
                       
                     <!-- ********* -->
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Name</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls"><input class="uk-width-1-1"
                                name="partner" 
                                data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_partner]" 
                                data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=partner" 
                            ></div>
                        
                            <div class="uk-form-controls">
                                    <label><input type="checkbox" class="toggle-color" name="register-new-partner">  <span data-lang>Create new</span> <span data-lang>Customers</span></label>
                            </div>
                        </div>                        
                        
                        
                        
                        <div class="uk-form-row uk-margin-top">
                            <label class="uk-form-label" data-lang>Company</label>
                            <div class="uk-form-controls uk-grid">
                                <input class="uk-width-small-2-3" 
                                    name="company" 
                                    title="Company name" data-lang
                                    data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_company],#modal-edit-order [name=id_partner]" 
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=name" 
                                >
                                <input class="uk-width-small-1-3" 
                                    placeholder="EIN" title="EIN" data-lang
                                    name="ein" 
                                    data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_company],#modal-edit-order [name=id_partner]" 
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=ein" 
                                >
                            </div>
                            
                        
                            <div class="uk-form-controls">
                                    <label><input type="checkbox" class="toggle-color" name="register-new-company"> <span data-lang>Crete new</span> <span data-lang>company</span>  </label>
                            </div>
                        </div>
                        <br>
                        
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label"><span data-lang>Contacts</span> <span class="uk-text-danger">*</span></label>
                            <div class="uk-form-controls uk-grid">
                                <input class="uk-width-small-1-2"
                                    name="email" 
                                    placeholder="Email" title="Email" data-lang 
                                    data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_company],#modal-edit-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=email" 
                                >
                                <input name="phone" class="uk-width-small-1-2"
                                    placeholder="Phone" title="Phone" data-lang
                                    data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_company],#modal-edit-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=phone" 
                                >
                            </div>
                        </div>
                        <br>
                        
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Address</label>
                            <div class="uk-form-controls uk-grid">
                                <input type="text"  class="uk-width-small-1-2" data-lang 
                                    name="country"
                                    placeholder="Country" title="Country"
                                    data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_company],#modal-edit-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=country"  
                                >
                            
                                <input type="text" class="uk-width-small-1-2" data-lang 
                                    name="city"
                                    placeholder="City" title="City"
                                    data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_company],#modal-edit-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=city" 
                                >
                        
                                <input class="uk-width-small-1-1" data-lang 
                                    name="address"
                                    placeholder="Address" title="Address"
                                    data-depends-on="#modal-edit-order [name=id_company_change],#modal-edit-order [name=id_company],#modal-edit-order [name=id_partner]"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/getPartnerData&field=address" 
                                >
                            </div>
                        </div>
                        
                    
                         
                        

                        
                        <hr>
                        <?php /***/ ?>
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Tax</label>
                            <div class="uk-form-controls uk-grid">
                                <select type="text"  class="uk-width-small-1-1" data-lang 
                                    name="key_tax"
                                    title="Tax"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/taxes/getList"   
                                >
                                </select>
                            </div>
                        </div>
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Delivery</label>
                            <div class="uk-form-controls uk-grid">
                                <select type="text"  class="uk-width-small-1-1" data-lang 
                                    name="key_delivery_method"
                                    title="Delivery"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/deliveries/getList"  
                                >
                                </select>
                            </div>
                        </div>
                        
                        <div class="uk-form-row">
                            <label class="uk-form-label" data-lang>Payment</label>
                            <div class="uk-form-controls uk-grid">
                                <select type="text"  class="uk-width-small-1-1" data-lang 
                                    name="key_payment_method"
                                    title="Payment"
                                    data-get="<?=URL_BASE?>ajax.php?f=sales/payments/getList"   
                                >
                                </select>
                            </div>
                        </div>
                        
                        
                    
                    <div class="uk-modal-footer uk-margin-top">
                        <button class="uk-button uk-button-primary"><span data-lang>Save</span></button>
                        <button class="uk-button uk-modal-close " data-lang>Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            $("#modal-edit-order").on("populated", function(e,ret){ 
                if(ret.data[0]['id_partner'] == 0 || !ret.data[0]['id_partner']) {
                    $("#modal-edit-order [name=register-new-partner]").prop("disabled",false).parent().removeClass("uk-text-muted");
                }else{
                    $("#modal-edit-order [name=register-new-partner]").prop("disabled",true).parent().addClass("uk-text-muted");
                }
                
                if( ret.data[0]['id_company'] > 0){
                    $("#modal-edit-order [name=register-new-company]").prop("disabled",true).parent().addClass("uk-text-muted");
                }else{
                    $("#modal-edit-order [name=register-new-company]").prop("disabled",false).parent().removeClass("uk-text-muted");
                }
            })
        </script>
        
        
        <?php /*** Modal Delete */ ?>
        <div id="modal-delete-order" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-small">  <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header">  <h3>Delete order</h3>  </div>
                <form action="<?=URL_BASE?>ajax.php?f=sales/postDelete" method="post" data-trigger="order-deleted" data-hide-on-submit>
                    <p>Are you sure you want to delete order #<b name="id"></b> ?</p>
                    <input type="hidden" name="id">
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger">Delete</button>
                        <button class="uk-modal-close uk-button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php /*** Modal Change STATUS */ ?>
        <div id="modal-change-status" class="uk-modal">
            <div class="uk-modal-dialog">  <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header">  <h3><span data-lang>Change status of order</span> #<b name="id"></b></h3>  </div>

                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=sales/postStatus" data-trigger="ordercart-changed,order-updated">
                    <input type="hidden" name="id">                
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Status</span> <span class="uk-text-danger">*</span> </label>
                        <div class="uk-form-controls">
                            <select class="select2 uk-width-1-1" style="width:100%" 
                                name="id_status"
                                data-get="<?=URL_BASE?>ajax.php?f=sales/statuses/getList&first=%2B Change status ..." 
                                data-templateResult='<span><i class="{{icon}}" style="color:{{color}}"></i> {{name}}</span>' 
                                data-templateSelection='<span><i class="{{icon}}" style="color:{{color}}"></i> {{name}}</span>' 
                                type="submit" 
                            ></select>
                        </div>
                    </div>
                </form>
                
                <table id="list-order-statuses" data-trigger-reload="ordercart-changed" data-get="<?=URL_BASE?>ajax.php?f=sales/statuses/getHistory" 
                    class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%">
                </table>
                <script>$("#list-order-statuses").DataTable({
                    dom: 't',
                    paginate: false,
                    ordering:false,
                    columns: [
                        { data: "icon", title:(lang["Icon"]||"Icon"), render:function(d,t,r){return '<i class="'+d+'" style="color:'+r['color']+'"></i>';}},
                        { data: "status", title:(lang["Status"]||"Status") },
                        { data: "date_add", title:(lang["Date"]||"Date")},
                        { data: "user", title:(lang["User"]||"User")},
                        { data: "project", title:(lang["From"]||"From")}
                    ]
                });</script>
                
                
                <div class="uk-modal-footer">
                    <button class="uk-modal-close uk-button" data-lang>Exit</button>
                </div>
            </div>
        </div>
        
        
        
        
         <?php /*** Modal cart */ ?>
        <div id="modal-cart-order" class="uk-modal">
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Items in order</span> #<span name="id"></span></h3> </div>
                
                <table id="list-orders-items" data-trigger-reload="order-cart-changed" data-get="<?=URL_BASE?>ajax.php?f=sales/orders_items/getCart" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" cellspacing="0" width="100%">
                    <tfoot><td></td> <td></td> <td></td> <td></td> <td></td><td class="uk-text-right">Sum:</td> <th></th> <td></td></tfoot>                    
                </table>
                <script>$("#list-orders-items").DataTable({
                    dom: 't',
                    paginate: false,
                    order: [[ "1", "asc" ]],
                    columns: [
                        { data: "image", title:"", orderable:false, sortable:false, render:function(d,t,r){
                            return '<img width="40" src="../products/image.php/'+d+'/small/'+r['date_add']+'">';
                        }   },
                        { data: "item", title:(lang["Item"]||"Item"), render:function(d,t,r){return r['id_item']+'. '+d;}},
                        { data: "note", title:(lang["Descr."]||"Descr.")},
                        { data: "qty", title:(lang["Qty"]||"Qty")},
                        { data: "mu", title: (lang["MU"]||"MU") },
                        { data: "price", title:(lang["U.Price"]||"U.Price")},
                        { data: "total", title: (lang["Total"]||"Total"), class:"sum", render:function(d,t,r,m){
                            return "<b>"+parseFloat(d).toFixed(2)+"</b>";
                        } },
                        { data: "actions", title:"", searchable:false, orderable:false, class:"uk-text-center uk-text-middle uk-text-nowrap",
                            render:function(d,t,r,m){
                                var del = '<a href="#modal-delete-from-cart" class="uk-icon-times" data-uk-modal="{modal:false}"  data-populate=\'{"id_item":"'+r.id_item+'","item":"'+r.item+'","id":"'+r.id+'"}\' title="Remove"></a>',
                                    edit= '<a href="#modal-edit-from-cart" class="uk-icon-edit" data-uk-modal="{modal:false}" data-get="id='+r.id+'" data-populate=\'{"id_item":"'+r.id_item+'","id":"'+r.id+'"}\' title="Edit"></a>';
                                return edit + " " + del;
                        }   }
                    ],
                    drawCallback: function(){ var api = this.api(); $( api.table().footer() ).find(".sum").html(
                        parseFloat(api.column( ".sum", {page:'current'} ).data().sum()).toFixed(2)
                    );}
                });</script>
                
                <div class="uk-text-right uk-margin-top">
                    <input type="hidden" name="id">
                    <a href="#add-to-cart" type="button" class="uk-button uk-button-success" data-uk-modal="{modal:false}"><i class="uk-icon-cart-arrow-down"></i> <span data-lang>Add</span></a>
                    <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                </div>
            </div>
        </div>
        
        <?php /*** Modal Edit from cart */ ?>
        <div id="modal-edit-from-cart" class="uk-modal" data-get="<?=URL_BASE?>ajax.php?f=sales/orders_items/getEditItem" data-hide-on-submit>
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Edit item in order</span> #<span name="id_parent"></span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=sales/orders_items/postEditItem" data-trigger="order-cart-changed,order-updated">
                    <input type="hidden" name="id_parent">
                    <input type="hidden" name="id">
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Item</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" type="hidden" name="id_item"></select>
                            <div class="uk-width-1-1" name="item" readonly></div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Description</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-width-1-1" type="text" name="note"></textarea>
                        </div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Qty</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid uk-grid-collapse">
                            <div class="uk-width-1-2">
                                <input class="uk-width-1-1" type="text" name="qty"
                                    data-depends-on="#add-to-cart [name=id_item]"
                                    data-get="<?=URL_BASE?>ajax.php?f=products/getItem"
                                >
                            </div>
                            <div class="uk-width-1-2">
                                <select class="uk-width-1-1" type="text" name="id_unit" 
                                    data-value-depends-on="#add-to-cart [name=qty]" 
                                    data-get="<?=URL_BASE?>ajax.php?f=products/units/getUnits"
                                ></select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Price</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" type="text" name="price"
                                data-depends-on="#add-to-cart [name=qty]"
                            >
                        </div>
                    </div>
                    
                    <div class="uk-text-right uk-margin-top">
                        <button type="submit" class="uk-button uk-button-primary" data-lang>Save</button>
                        <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php /*** Modal add to cart */ ?>
        <div id="add-to-cart" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Add item to Order</span> #<span name="id_parent"></span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=sales/orders_items/postAppendCart" data-trigger="order-cart-changed,order-updated">
                    <input type="hidden" name="id_parent">
                    <div class="uk-form-row">
                        <label class="uk-form-label">Product <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <select class="uk-width-1-1 select2" name="id_item" style="width:100%" 
                                data-ajax--url="<?=URL_BASE?>ajax.php?f=sales/searchItems" 
                                data-templateResult='
                                    <img class="uk-align-left" src="../products/image.php/{{id}}/small" width="40"> 
                                    <span>{{id}}</span> {{text}} <small class="uk-text-muted">ref: {{reference}}</small>
                                    <div><sup><i>{{category}}</i></sup></div>'
                                data-templateSelection='
                                    <img src="../products/image.php/{{id}}/small" width="20"> 
                                    <span>{{id}}</span> {{text}}
                                    <small class="uk-text-muted>ref.{{reference}}</small>'
                            ></select>
                        </div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Description</label></label>
                        <div class="uk-form-controls">
                            <textarea class="uk-width-1-1" type="text" name="note"></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Qty</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls uk-grid uk-grid-collapse">
                            <div class="uk-width-1-2">
                                <input class="uk-width-1-1" type="text" name="qty"
                                    data-depends-on="#add-to-cart [name=id_item]"
                                    data-get="<?=URL_BASE?>ajax.php?f=products/getItem"
                                >
                            </div>
                            <div class="uk-width-1-2">
                                <select class="uk-width-1-1" type="text" name="id_unit" 
                                    data-value-depends-on="#add-to-cart [name=qty]" 
                                    data-get="<?=URL_BASE?>ajax.php?f=products/units/getUnits"
                                ></select>
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Price</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" type="text" name="price"
                                data-depends-on="#add-to-cart [name=qty]"
                            >
                        </div>
                    </div>
                    
                    <div class="uk-text-right uk-margin-top">
                        <button type="submit" class="uk-button uk-button-primary" data-lang>Add</button>
                        <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php /*** Modal delete from cart */?>
         <div id="modal-delete-from-cart" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-small"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3 data-lang>Remove item</h3> </div>
                <form action="<?=URL_BASE?>ajax.php?f=sales/orders_items/postRemove" method="post" data-trigger="order-cart-changed,order-updated">
                    <p><span data-lang>Remove this item</span> <br>"<b name="id_item"></b>. <b name="item"></b>" ?</p>
                    <input type="hidden" name="id_parent">
                    <input type="hidden" name="id_item">
                    <input type="hidden" name="id"> 
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon-times"></i> <span data-lang>Remove</span></button>
                        <button class="uk-modal-close uk-button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    
    
    </div> 

        <script>
            $(".toggle-color").on("click",function(e){
                if($(this).prop("checked")){
                    $(this).parent().addClass("uk-form-danger");
                }else{
                    $(this).parent().removeClass("uk-form-danger");
                }
            });
        </script>

        
        
        <?php include '../snipps/foot.php'; ?>
        
        <script src="<?=$_ASSETS['application.js']?>"></script>
        
    </body>
</html>