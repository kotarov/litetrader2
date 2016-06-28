<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>List Products</title>
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

        
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.dotnav.css']?>" />
        <script src="<?=$_ASSETS['uikit.slideset.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
    </head>
    
    <body id="page-products"> 
        <?php include '../snipps/head.php'; ?>
        
        <ul class="uk-breadcrumb"> 
            <li><a href="<?=URL_BASE?>products/"><i class="uk-icon-home"></i> Home</a></li>
        </ul>
        

        <div id="categories-list" class="uk-grid" data-uk-grid-margin></div>
        
        <hr>
        <h2>Продукти в тази категория</h2>
        <div id="products" class="uk-grid uk-container-center"></div>
        
        <script>
        function initProducts(){
            url = decodeURIComponent(window.location).split("/");
            id = parseInt(url[ url.length-2 ].split("-")[0], 10);
            $.getJSON("<?=URL_BASE?>ajax.php?f=products/getCategories&id="+id).done(function(ret){
                $(".uk-breadcrumb").html('<li><a data-live href="<?=URL_BASE.URL_PRODUCTS?>/"><i class="uk-icon-home"></i> Home</a></li>');
                
                $.each(ret.parents, function(k,v){
                    $(".uk-breadcrumb").append('<li><a data-live href="<?=URL_BASE.URL_PRODUCTS?>'+v.url_rewrite+'">'+v.title+'</a></li>');
                });
                if(ret.current){
                    $(".uk-breadcrumb").append('<li>'+ret.current.title+'</li>');
                }
                if(typeof ret.current.name !== "undefined") $(".uk-breadcrumb").append('<li><span>'+ret.current.name+'</span></li>');
                
                $("#categories-list").html("").hide();
                if(ret.categories.length > 0 ){
                    $.each(ret.categories, function(k,v){
                        $("#categories-list").append(''
                        +'<div class="uk-width-medium-1-2 uk-width-large-1-3">'
                            +'<div class="uk-panel uk-panel-box">'
                                +'<div class="uk-panel-teaser">'
                                    +'<a data-live href="<?=URL_BASE.URL_PRODUCTS?>'+v.url_rewrite+'">'
                                    +'<img src="<?=URL_BASE?>imageCategory.php/'+v.id+'/thumb/'+v.date_image+'" alt="">'
                                    +'</a>'
                                +'</div>'
                                
                                +'<h3 class="uk-panel-title" style="position:relative;margin-bottom:0">'
                                    +'<a data-live href="<?=URL_BASE.URL_PRODUCTS?>'+v.url_rewrite+'">'+v.title+'</a>'
                                +'</h3>'
                            +'</div>'
                        +'</div>'
                        );
                    });
                }
                $("#categories-list").fadeIn();
                

                
                $("#products").html("").hide();
                if(ret.data.length == 0){
                    $("#products").html('<span class="uk-text-warning">В тази категория няма налични продукти</span>');
                }else {
                    $.each(ret.data, function(r,p){
                        $("#products").append(''
                            +'<div class="uk-margin uk-margin-top">'
                            +'<a class="uk-thumbnail uk-thumbnail-medium" href="<?=URL_BASE.URL_PRODUCT?>'+(p.url_rewrite?p.url_rewrite:'/')+p.id+'-'+p.title.replace(/\ /g,"-")+'/">'
                                +'<img src="<?=URL_BASE?>image.php/'+p.id_image+'/thumb/'+p.date_add+'" alt="">'
                                +'<div class="uk-thumbnail-caption" style="height:7em">'
                                    +'<div class="uk-text-bold uk-text-left  uk-margin-bottom uk-margin-top uk-margin-left" style="height:2em">'+p.title+'</div>'
                                    +'<div class="uk-text-large uk-text-bold uk-text-primary uk-float-left uk-margin-left" style="font-size:1.5em">'
                                        +'<span class="">'+(parseFloat(p.price)).toFixed(2)+' лв</span>'
                                    +'</div>'
                                    +'<div>'
                                        +'<div class="uk-float-right uk-margin-right">'
                                            +(p.is_avaible ? 
                                            '<button class="uk-button uk-button-primary" data-addtocart="'+p.id+'"><i class="uk-icon-shopping-bag"></i>&nbsp;&nbsp; В кошницата</button>'
                                            : '<i class="uk-text-muted">Не е наличен</i>')
                                        + '</div>'
                                    +'</div>'
                                +'</div>'
                            +'</a>'
                            +"</div>"
                        );
                    });
                }
                 $("#products").fadeIn();
                
                $(window).trigger('resize');
            });
        }
        initProducts();
        </script>
            
        <script>
            $("body").on("click","a[data-live]",function(e){
                e.preventDefault();
                history.pushState(null, null, $(this).attr("href"));
                initProducts();
            });
            
            $(window).on('popstate', function() {
                initProducts();
            });
            
            $("body").on("click","[data-addtocart]",function(e){
                e.preventDefault();
                $.post("<?=URL_BASE?>ajax.php?f=cart/postAdd",{"id_product":$(this).data("addtocart"),"add":"1"}).done(function(cart){
                    cart = $.parseJSON(cart);
                    if(cart.error){ UIkit.notify(cart.error,"warning");
                    }else{
                        $(document).trigger("shopping-cart-changed",cart);
                        UIkit.modal("#modal-cart").show();
                    }
                });
            })
        </script>
        
        
        <br>   
        <?php include '../snipps/featured.php';?>
            
            
        <br><br>
        <?php include '../snipps/foot.php'; ?>
        <script src="<?=URL_BASE?>js/application.js"></script>
    </body>
    
</html>