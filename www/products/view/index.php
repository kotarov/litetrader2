<?php include '../../snipps/init.php'; ?>
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
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.dotnav.css']?>" />
        <script src="<?=$_ASSETS['uikit.slideset.js']?>"></script>
        
        <!--script src="<?=$_ASSETS['uikit.lightebox.js']?>"></script-->
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        
        <script src="<?=$_ASSETS['elevatezoom.js']?>"></script>
        
        <style>
            .zoomGalleryActive { border: 1px solid #ccc;}
        </style>
    </head>
    <body id="page-products"> 
        <?php include '../../snipps/head.php'; ?>
       
       
        <?php
            $_GET['id'] = 0;
            if(isset($_SERVER['PATH_INFO'])){
                $temp = explode("/", $_SERVER['PATH_INFO']);
                $nb = count($temp); if($nb < 2) $nb = 2;
                $temp = $temp[$nb-2];
                list($_GET['id'], $temp) = explode('-',$temp);

            }
            $NO_JSON = TRUE;
            $product = include __DIR__."/../../../ajax/www/products/getProduct.php";
       ?>
        <ul class="uk-breadcrumb">
            <li><a href="<?=URL_BASE?>products/"><i class="uk-icon-home"></i> <span data-lang>Начало</span></a></li>
            <?php if(isset($product['parents'])) foreach($product['parents'] AS $n=>$parent) { ?>
                <li><a href="<?=URL_BASE?>products/index.php<?=$parent['url_rewrite']?>"><?=$parent['title']?></a></li>
            <?php } ?>
            <?php if($product['data']['url_rewrite']) { ?>
                <li class="uk-active"><a href="<?=URL_BASE.'products/index.php'.$product['data']['url_rewrite']?>"><?=$product['data']['category']?></a></li>
            <?php } ?>
        </ul>
        

        <h2 style="margin-top:0"><span id="product_name"><?=$product['data']['title']?></span> </h2>
        <div class="uk-grid uk-margin-bottom" data-uk-grid-margin>
           <div class="uk-width-medium-1-2">
                <div class="uk-overlay uk-width-1-1 uk-thumbnail">
                    <a data-uk-lightbox="{group:'main-image'}" href="#">
                        <img id="main-image" class="uk-width-1-1" style="max-height:100%" src="<?=URL_BASE?>image.php/<?=$product['data']['id_image']?>/<?=$product['data']['date_add']?>/">
                    </a>
                </div>
                
                <div id="product-images" class="uk-thumbnav uk-grid-width-1-5 uk-margin-remove">
                    <?php foreach($product['images'] AS $image) {  $url = URL_BASE.'image.php/'.$image['id'].'/full/'.$image['date_add'];?>
                        <a href="#" data-image="<?=$url?>" data-uk-lightbox="{group:'main-image'}" class="uk-width-1-5<?=$image['is_cover']?' zoomGalleryActive':''?>">
                            <img src="<?=$url?>">
                        </a>
                    <?php } ?>
                </div>
           </div>
           <script>
               $("#main-image").elevateZoom({ gallery:"product-images" });
           </script>
           
           
           <div class="uk-width-medium-1-2 uk-grid ">
                
                <div class="uk-width-1-1">
                    <div class="uk-margin-top"><span class="uk-text-primary">
                        <span id="price" class="product-view-price"><?=$product['data']['price']?></span><span class="uk-text-large"> лв</span></span>
                    </div>
                    
                    <br>
                    
                    <div class="uk-panel uk-panel-box uk-panel-box-primary">
                        <span id="description"><?=$product['data']['description']?></span>
                    </div>
                    
                    <div class="uk-margin-top uk-margin-bottom">
                        <span class="uk-font-bold" data-lang>Код:</span> <span id="reference" class="uk-text-muted uk-text-small"><?=$product['data']['reference']?></span>
                    </div>
                    
                    <div class="uk-panel uk-text-center"> 
                        <?php if($product['data']['is_avaible'] == 1) { ?>
                        <button class="buy-product uk-button uk-button-primary uk-button-large">
                            <i class="uk-icon-shopping-bag"></i>&nbsp;&nbsp; В кошницата
                        </button> 
                        <?php }else{ ?>
                        <i class="uk-text-muted">Не е наличен</i>
                        <?php } ?>
                    </div>
                    <script> 
                        $("body").on("click",".buy-product",function(e){ e.preventDefault();
                            $.post("<?=URL_BASE?>ajax.php?f=cart/postAdd",{"id_product":<?=$product['data']['id']?>,"add":"1"}).done(function(cart){
                                cart = $.parseJSON(cart);
                                if(cart.error){ UIkit.notify(cart.error,"warning");
                                }else{
                                    $(document).trigger("shopping-cart-changed",cart);
                                    UIkit.modal("#modal-cart").show();
                                }
                            });
                        }); 
                    </script>
                    
                    
                    <h3 class="uk-text-primary" data-lang>Детайли</h3>
                    <hr>
                    <div id="content" class="uk-width-medium-1-1"><?=$product['data']['content']?></div>

                    <?php /*
                    <h3 class="uk-text-primary" data-lang>Контакти</h3>
                    <hr>
                    <div id="contacts"></div>
                    */?>

                </div>


                
           </div>
           
           
           
        </div>
        
        <script>
        
            /*** INIT */
            <?php /*
            url = decodeURIComponent(window.location).split("/");
            window['id_product'] = parseInt(url[ url.length-2 ].split("-")[0], 10);
            $.getJSON("<?=URL_BASE?>ajax.php?f=products/getProduct&id="+window['id_product']).done(function(ret){
                $(".uk-breadcrumb").html('<li><a href="<?=URL_BASE?>products/"><i class="uk-icon-home"></i> Home</a></li>');
                $.each(ret.parents, function(r,c){
                    $(".uk-breadcrumb").append('<li><a href="<?=URL_BASE.URL_PRODUCTS;?>'+c.url_rewrite+'">'+c.title+'</a></li>');
                });
                if(ret.data.category)
                    $(".uk-breadcrumb").append('<li class="uk-active"><a href="<?=URL_BASE.URL_PRODUCTS;?>'+ret.data.url_rewrite+'">'+ret.data.category+'</a></li>');
                
                var imgSRC = "<?=URL_BASE?>image.php/"+ret.data.id_image+"/"+ret.data.date_add+"/";
                $("#main-image").attr("src",imgSRC);
                
                $("#product_name").html(ret.data.title);
                $.each(ret.data, function(id,value){ $("#"+id).html(value) });
                
                $("#product-images").html("");
                $.each(ret.images, function(k,v){
                    var url = '<?=URL_BASE?>image.php/'+v.id+'/full/'+v.date_add;
                    $("#product-images").append('<a href="#" data-image="'+url+'" data-uk-lightbox="{group:\'main-image\'}" class="uk-width-1-5"><img src="'+url+'"> </a>');
                });
                
                if(ret.data.is_avaible == 1) {
                    $(".buy-product").show();
                    $(".cannot-buy-poduct").hide();
                    
                }else {
                    $(".buy-product").hide();
                    $(".cannot-buy-poduct").show();
                }
                
                $("#main-image").elevateZoom({
                    tint:true, tintColour:'black', tintOpacity:0.5,
                    gallery:"product-images", 
                });
                
            }); 
            */ ?>
        </script>
        
        
        <br>        
        <?php include '../../snipps/featured.php';?>        
        
        <div class="uk-margin"> </div>
        
        <script src="<?=URL_BASE?>js/application.js"></script>
        <?php include '../../snipps/foot.php'; ?>
        
    </body>
</html>