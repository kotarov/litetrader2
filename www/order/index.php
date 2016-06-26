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
        <script src="<?=$_ASSETS['uikit.lightebox.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        
        <style>
            .cart-depends { display:none;}
        </style>
    </head>
    
    <body id="page-order"> 
        <?php include '../snipps/head.php'; ?>
        <h1 data-lang>Данни за поръчката</h1>
        
        <br>
        <div class="cart-dependans-reverse">
            <p class="uk-alert" data-lang>Кошницата Ви е празна. </p>
        </div>
        <div id="container">
        
        
        <h2 name="cart-container"><b class="uk-badge uk-badge-notification">1</b> <span data-lang>Пазарска кошница</span></h2>
        <hr>
        <div class="uk-grid">
            <div class="uk-width-medium-1-6"></div>
            <div class="uk-width-medium-2-3"><?php include __DIR__.'/../cart/content.php'; ?></div>
        </div>
        
        <br>
        <form class="uk-form uk-form-horizontal cart-depends" action="postOrder">    
            <h2><b class="uk-badge uk-badge-notification">2</b> <span data-lang>Адрес</span></h2>
            <hr>
            <div class="uk-grid">
                <div class="uk-width-medium-1-6"></div>
                <div class="uk-width-medium-2-3" id="address">
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Имена</span> <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="customer" class="uk-width-1-1"></div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Телефон</span> <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="phone" class="uk-width-1-1"></div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label">Email <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="email" class="uk-width-1-1"></div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Адрес</span> <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="address" class="uk-width-1-1"></div>
                    </div>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Град</span> <b class="uk-text-danger">*</b></label>
                        <div class="uk-form-controls"><input name="city" class="uk-width-1-1"></div>
                    </div>
                </div>
            </div>
            <script>
                $.getJSON("<?=URL_BASE?>ajax.php?f=getLogged").done(function(d){ 
                    if(d.id){
                        $("#address [name=customer]").val(d.name+' '+d.family);
                        $("#address [name=phone]").val(d.phone);
                        $("#address [name=address]").val(d.address);
                        $("#address [name=city]").val(d.city);
                        $("#address [name=email]").val(d.email);
                    }
                });
            </script>
    
    
            <?php $payment_methods = parse_ini_file(INI_DIR.'www/payment_methods.ini',true); ?>
            
            <br>
            <br>
            <h2><b class="uk-badge uk-badge-notification">3</b> <span data-lang>Начин на плащане</span> <i class="uk-text-danger">*</i></h2>
            <hr>
            <div class="uk-grid" name="choose-method">
                <div class="uk-width-medium-1-6"></div>
                <div class="uk-width-medium-2-3">
                    
                    <?php foreach($payment_methods as $key=>$method) { ?>
                    <div class="uk-form-row">
                        <div class="">
                            <label class="uk-text-large" style="cursor:pointer">
                                <input type="radio" name="method" value="<?=$key?>" class="uk-margin-right"> 
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
                            <button class="uk-button uk-button-primary uk-button-large" id="submit-order">&nbsp;&nbsp;&nbsp; <span data-lang>Поръчай</span> &nbsp;&nbsp;&nbsp;</button>
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
                
                $.post("<?=URL_BASE?>ajax.php?f=customer/"+$(this).attr('action'), $(this).serialize()).done(function(ret){
                    $("body").find(".uk-alert").remove();
                    ret = $.parseJSON(ret);
                    if(ret.required){
                        $.each(ret.required, function(i,field){ $("[name='"+field+"']", $form).addClass("uk-form-danger"); });
                        UIkit.notify('<i class="uk-icon-asterisk"></i>'+" Fill down Required fields","danger");
                    }else if(ret.error){
                        $("body").prepend('<div class="uk-alert uk-alert-danger"><b>'+ret.error+'</b></div>');
                    }else if(ret.success){
                        $("#container").find("input").prop("disabled",true);
                        var m = '<h3 id="message-success" class="uk-alert uk-alert-success">Order submited successfull.</h3>';
                        
                        $("#container").prepend(m);
                        $("#submit-order").hide();
                        $("#shcart-badge").hide();
                        $("#shcart-price").hide();
                        
                        $('html, body').stop().animate({ scrollTop: ($("#message-success").offset().top - 70) }, 1000);
                    }
                });
            });
            
            $(document).on("shopping-cart-changed",function(e,cart){
                if(cart.nb){  $(".cart-depends").show();$(".cart-dependans-reverse").hide();}
                else{ $(".cart-depends").hide(); $(".cart-dependans-reverse").show();}
            });
        </script>
    
        </div> <?php /** /container */?>
    
    
        <div class="uk-margin-large-bottom"></div>
        <script src="<?=URL_BASE?>js/application.js"></script>
        <?php include '../snipps/foot.php'; ?>
    </body>
</html>