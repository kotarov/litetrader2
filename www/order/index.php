<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>

        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.dotnav.css']?>" />
        <script src="<?=$_ASSETS['uikit.slideset.js']?>"></script>
        <?php /*<script src="<?=$_ASSETS['uikit.lightebox.js']?>"></script> */?>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        <link href="<?=$_ASSETS['uikit.form.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.form.js']?>"></script>
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        
        <link  href="<?=$_ASSETS['select2.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['select2.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">        
        <style>
            .cart-depends { display:none;}
        </style>
    </head>
    
    <body id="page-order"> 
        <?php include '../snipps/head.php'; ?>
        <h1 data-lang>Данни за поръчката</h1>
        
        <br>
        <div class="cart-dependans-reverse">
            <p class="uk-alert"> <b data-lang>Кошницата Ви е празна!</b><br> <i>Зада направите поръчка, моля сложете поне един продукт в кошницата си.</i></p>
        </div>
        <div id="container">
        
        
        <h2 name="cart-container" class="cart-depends"><b class="uk-badge uk-badge-notification">1</b> <span data-lang>Продукти</span></h2>
        <hr>
        <div class="uk-grid cart-depends">
            <div class="uk-width-medium-1-6">&nbsp;</div>
            <div class="uk-width-medium-4-6"><?php include __DIR__.'/../cart/content.php'; ?></div>
        </div>
        
        <br>
        <form id="form-order" class="uk-form uk-form-horizontal cart-depends no-ajax" action="">    
            <h2><b class="uk-badge uk-badge-notification">2</b> <span data-lang>Адрес</span></h2>
            <hr>
            <div class="uk-grid">
                <div class="uk-width-medium-1-6"></div>
                <div class="uk-width-medium-2-3" id="address">
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Имена</span> <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="partner" class="uk-width-1-1"></div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Телефон</span> <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="phone" class="uk-width-1-1"></div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label">Email <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="email" class="uk-width-1-1"></div>
                    </div>
                    
                    
                    <?php /*
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Държава</span></label>
                        <div class="uk-form-controls"><input name="country" class="uk-width-1-1" value="България" disabled></div>
                    </div> */ ?>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Адрес</span> <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="address" placeholder="кв. ул. № ап." class="uk-width-1-1"></div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Държава / Град</span> <b class="uk-text-danger">*</b></label>
                        <?php $opts = '';
                            foreach(parse_ini_file(INI_DIR.'cities-bg.ini',true) AS $region=>$cc){
                                $opts .= '<optgroup label="обл. '.$region.'">';
                                foreach($cc AS $city=>$rr) $opts .= '<option value="'.$city.'" data-region="'.$region.'">'.$city.'</option>';
                                $opts .= '</optgroup>';
                            }
                        ?>
                        <div class="uk-form-controls">
                            <div class="uk-grid uk-grid-collapse uk-margin-remove">
                                <input name="country" class="uk-width-1-3" value="България" disabled>
                                <select name="city" style="width:66%" class="uk-width-2-3">
                                    <optgroup><option value="0" data-region="">-</option></optgroup>
                                    <?=$opts?>
                                </select>
                            </div>
                        </div>
                        <script> $("#form-order [name=city]").select2({templateSelection:function(data){
                            var reg = data.element.attributes['data-region'].value;
                            return data.text + (reg ? ' (обл. '+reg+')' : '');
                        }}); </script>
                    </div>
                </div>
            </div>
            <script>
                $.getJSON("<?=URL_BASE?>ajax.php?f=getLogged").done(function(d){ 
                    if(d.id){
                        $("#address [name=partner]").val(d.name+' '+d.family);
                        $("#address [name=phone]").val(d.phone);
                        $("#address [name=address]").val(d.address);
                        $("#address [name=city]").val(d.city).trigger("change");
                        $("#address [name=email]").val(d.email);
                    }else{
                        $("#address [name=partner]").val(d.partner);
                        $("#address [name=phone]").val(d.phone);
                        $("#address [name=address]").val(d.address);
                        $("#address [name=city]").val(d.city).trigger("change");
                        $("#address [name=email]").val(d.email);
                    }
                });
            </script>
    
    
            <?php $delivery_methods = parse_ini_file(INI_DIR.'www/delivery_methods.ini',true); ?>
            <br><br>
            <h2><b class="uk-badge uk-badge-notification">3</b> <span data-lang>Доставчик</span> <i class="uk-text-danger">*</i></h2>
            <hr>
            <div class="uk-grid" name="delivery-method">
                <div class="uk-width-medium-1-6"></div>
                <div class="uk-width-medium-2-3" id="list_delivery_methods">
                    <div class="uk-text-muted"> Изберете град </div>
                </div>
            </div>
            <script>
                $("#address [name=city]").on("change",function(e){
                    $.getJSON("<?=URL_BASE?>ajax.php?f=getDeliveryMethods&city="+$(this).val() ).done(function(ret){
                        var l = "";
                        $.each(ret.data,function(k,v){
                            var price = parseFloat(v['price']).toFixed(2,10);
                            l += '<div class="uk-form-row">'
                                    +'<div class="">'
                                        +'<label class="uk-text-large" style="cursor:pointer">'
                                            +'<input type="radio" name="delivery_method" value="'+k+'" class="uk-margin-right">'
                                            +'<span class="uk-button uk-button-success">'+(isNaN(price)?'0.00':price)+' лв </span> '
                                            +v['title']
                                        +'</label>'
                                    +'</div>'
                                +'</div>';
                        });
                        $("#list_delivery_methods").html(l);
                    });
                });
            </script>
    
    

            <?php $payment_methods = parse_ini_file(INI_DIR.'www/payment_methods.ini',true); ?>
            <br>
            <br>
            <h2><b class="uk-badge uk-badge-notification">4</b> <span data-lang>Начин на плащане</span> <i class="uk-text-danger">*</i></h2>
            <hr>
            <div class="uk-grid" name="payment-method">
                <div class="uk-width-medium-1-6"></div>
                <div class="uk-width-medium-2-3">
                    
                    <?php foreach($payment_methods as $key=>$method) { ?>
                    <div class="uk-form-row">
                        <div class="">
                            <label class="uk-text-large" style="cursor:pointer">
                                <input type="radio" name="payment_method" value="<?=$key?>" class="uk-margin-right"> 
                                <?=$method['title'];?>
                            </label>
                        </div>
                    </div>
                    <?php } ?>
    
                </div>
            </div>
            
            <br><br><br>
            <div class="uk-grid cart-depends">
                <div class="uk-width-medium-1-6"></div>
                <div class="uk-width-medium-2-3">
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span class="uk-description uk-float-rigt uk-text-warning">* <span data-lang>Всички полета са задължителни!</span></label>
                        <div class="uk-form-controls">
                            <button class="uk-button uk-button-primary uk-button-large" id="submit-order">&nbsp;&nbsp;&nbsp; <span data-lang>Преглед</span> &nbsp;&nbsp;&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    
    
    
    
        <script>
            $("form").on("submit",function(e){ 
                e.preventDefault();
                var $form = $(this);
                $(".uk-form-danger", $form).removeClass('uk-form-danger');
                
                $.post("<?=URL_BASE?>ajax.php?f=orders/postValidateOrder", $(this).serialize()).done(function(ret){
                    $("body").find(".uk-alert").remove();
                    ret = $.parseJSON(ret);
                    if(ret.required){
                        $.each(ret.required, function(i,field){ $("[name='"+field+"']", $form).addClass("uk-form-danger"); });
                        UIkit.notify('<i class="uk-icon-asterisk"></i>'+" Попълнете Задължителните полета","danger");
                        $('html, body').stop().animate({ scrollTop: ($(".uk-form-danger").offset().top - 70) }, 1000);
                    }else if(ret.error){
                        $("body").prepend('<div class="uk-alert uk-alert-danger"><b>'+ret.error+'</b></div>');
                        $('html, body').stop().animate({ scrollTop: ($(".uk-alert-danger").offset().top - 30) }, 1000);
                    }else if(ret.success){
                        $.each(ret.order,function(k,v){
                            if(k=='tax_price') v = parseFloat(v).toFixed(2,10);
                            $("[name="+k+"]", "#modal-order-summary").html(v);
                        });
                        
                        if(ret.order.tax_price > 0){
                            $("#order-summary-products").find(".cart-tax").show();
                        }else{
                            $("#order-summary-products").find(".cart-tax").hide();
                        }
                        
                        $("#order-summary-products tbody").html("");
                        var n =1;
                        $.each(ret.cart,function(k,v){
                            $("#order-summary-products tbody").append(
                                '<tr><td>'+(n++)+'</td><td>'+v.title+'</td><td class="uk-text-right">'+parseFloat(v.price).toFixed(2)+'</td>'
                                +'<td class="uk-text-center">'+v.qty+'</td><th class="uk-text-right">'+(v.qty*v.price).toFixed(2)+'</th></tr>'
                            );
                        });
                        UIkit.modal("#modal-order-summary").show();
                    }
                });
            });
            
            $(document).on("shopping-cart-changed",function(e,cart){
                if(cart.nb){  $(".cart-depends").show();$(".cart-dependans-reverse").hide();}
                else{ $(".cart-depends").hide(); $(".cart-dependans-reverse").show();}
            });
        </script>
        
        
        <div id="modal-order-summary" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-large"><a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"><h3 data-lang>Преглед на заявката</h3></div>
                
                <div class="uk-margin-small-bottom uk-text-center"> <label>Дата:</label> <span class="uk-text-bold" name="date_add"></span></div>                
                <div class="uk-panel uk-panel-box">
                <table class="uk-table uk-table-condensed">
                    <tr><td class="uk-width-1-4">Имена</td><td class="uk-text-bold" class="uk-width-1-1" name="partner"></td></tr>
                    <tr><td class="">Телефон</td><td class="uk-text-bold" name="phone"></td></tr>
                    <tr><td class="">Email</td><td class="uk-text-bold" name="email"></td></tr>
                    <tr><td class="">Адрес</td><td class="uk-text-bold" name="address"></td></tr>
                </table>
                </div>
                
                <div class="uk-margin-top" style="overflow-x:auto">
                <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed" id="order-summary-products">
                    <thead><tr>
                        <th class="uk-text-center">№</th><th>Продукт</th><th class="uk-text-right">Цена</th><th class="uk-text-center">Кол.</th><th class="uk-text-right">Сума</th>
                    </tr></thead>
                    <tbody style="border-top:1px solid #ccc;border-bottom:1px solid #ccc"></tbody>
                    <tfoot><tr>
                        <tr><td colspan="4" class="uk-text-right">Продукти</td><td class="uk-text-right" name="price"></td></tr>
                        <tr class="cart-tax"><td colspan="4" class="uk-text-right"><span name="tax"></span></td><td class="uk-text-right" name="tax_price"></td></tr>
                        <tr><td colspan="4" class="uk-text-right">Доставчик "<span class="uk-text-bold" name="delivery_method"></span>"</td><td class="uk-text-right" name="delivery_price"></td></tr>
                        <tr style="border-top:1px solid #ccc"><th colspan="4" class="uk-text-right uk-text-danger">Всичко</th><th class="uk-text-bold uk-text-danger uk-text-right uk-text-large" name="total"></th></tr> 
                    </tr></tfoot>
                </table>
                </div>
                
                <div class="uk-text-right uk-panel">
                    <span>Начин на плащане</span>: <span class="uk-text-bold uk-text-primary" name="payment_method"></span>
                </div>
                
                <div class="uk-modal-footer">
                    <button class="uk-button uk-modal-close uk-button-large" data-lang>Обратно</button>
                    <a href="<?=URL_BASE?>order/view" id="end-order" class="uk-button uk-button-danger uk-button-large uk-float-right checkout"><i class="uk-icon-check"></i> <span>Заяви</span></a>
                </div>
            </div>
        </div>
        <script>
            $("#end-order").on("click",function(e){
                e.preventDefault();
                var email = $("#modal-order-summary [name=email]").text();
                var date  = $("#modal-order-summary [name=date_add]").text();
                var url = $(this).attr("href") + '?email='+email+'&date_add='+date+'&post';
                window.location.replace(url);
            });
        </script>
        
    
        </div> <?php /** /container */?>
    
    
        <div class="uk-margin-large-bottom"></div>
        <script src="<?=URL_BASE?>js/application.js"></script>
        <?php include '../snipps/foot.php'; ?>
    </body>
</html>