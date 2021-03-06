<?php include '../../snipps/init.php'; ?>
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

        <link href="<?=$_ASSETS['uikit.form.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.form.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>

        <script src="<?=$_ASSETS['typewatch.js']?>"></script>    
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.dotnav.css']?>" />
        <script src="<?=$_ASSETS['uikit.slideset.js']?>"></script>
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
    </head>
    
    <body id="page-products"> 
        <?php include '../../snipps/head.php'; ?>
        
        <h2 data-lang>Търсене на продукт</h2>
        <form id="form-search-product" class="uk-form uk-panel-box uk-margin-bottom" method="post" action="<?=URL_BASE?>ajax.php?f=products/search">
            <div class="uk-form-row">
                <div class="uk-form-controls uk-flex uk-flex-wrap">
                    <?php 
                        $dbh = new PDO('sqlite:'.DB_DIR.'products');
                        $cats=$dbh->query("SELECT id, title FROM categories where id_parent=0")->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    
                    <select name="id_category" onchange="searchProduct()" class="uk-text-primary uk-form-large uk-width-medium-3-10 uk-large-2-10">
                        <option value="0">Навсякъде</option>
                        <?php foreach($cats AS $cat){ ?>
                            <option value="<?=$cat['id']?>"><?=$cat['title']?></option>
                        <?php } ?>
                    </select>
                    <div class="uk-form-icon uk-width-small-8-10 uk-width-medium-6-10 uk-large-7-10">
                        <i class="uk-icon-search"></i>
                        <input type="search" class="uk-width-1-1 uk-form-large" name="search_product" placeholder="Започнете да въвеждате">
                        <script>
                            $("#form-search-product [name=search_product]").typeWatch({ callback: searchProduct,captureLength: 1 });
                            $("#form-search-product [name=search_product]").on("keyup",function(e){
                                $("#products").html('<h1 class="uk-width-1-1 uk-text-large uk-text-muted uk-text-center uk-margin-top"><i class="uk-icon-circle-o-notch uk-icon-spin"></i></h1>');
                            });
                            function searchProduct(value){
                                if(!value) value = $("#form-search-product [name=search_product]").val();
                                var id_category = $("#form-search-product [name=id_category]").val();
                                var url = $("#form-search-product").attr("action");
                                
                                $.post(url,{"id_category":id_category,"search":encodeURI(value)}).done(function(ret){
                                    ret =$.parseJSON(ret);
                                    var content='';
                                    if(ret.results.length > 0){
                                        $.each(ret.results, function(r,p){
                                            content +=''
                                            +'<div class="uk-width-large-1-4 uk-width-medium-1-3 uk-width-small-1-2 uk-width-1-1 uk-margin-bottom">'
                                            +'<a class="uk-panel products-list-panel" href="<?=URL_BASE.URL_PRODUCT?>'+(p.url_rewrite?p.url_rewrite:'/')+p.id+'-'+p.title.replace(/\ /g,"-")+'/">'
                                                //+'<div class="uk-badge uk-panel-badge uk-text-large">New</div>'
                                                +'<div class="uk-panel-teaser">'
                                                    +'<figure class="uk-overlay">'
                                                        +'<img src="<?=URL_BASE?>image.php/'+p.id_image+'/thumb/'+p.date_add+'" alt="'+(p.url_rewrite?p.url_rewrite:'/')+p.id+'-'+p.title.replace(/\ /g,"-")+'">'
                                                        +(p.category_title ? 
                                                        '<figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom">'+p.category_title+'</figcaption>'
                                                        : '')
                                                    +'</figure>'
                                                +'</div>'
                                                +'<div class="uk-text-muted uk-text-center products-list-title">'+p.title+'</div>'
                                                
                                                +'<div class="uk-width-1-1 uk-margin-top uk-margin-bottom">'
                                                    +'<div class="uk-text-center uk-margin-bottom">'
                                                        +'<span class="uk-text-primary products-list-price">'+(parseFloat(p.price)).toFixed(2)+' лв</span>'
                                                    +'</div>'
                                                    
                                                    +'<div class="uk-text-center">'
                                                        +(p.is_avaible ? 
                                                        '<button class="uk-button uk-button-primary" data-addtocart="'+p.id+'"><i class="uk-icon-shopping-bag"></i>&nbsp;&nbsp; В кошницата</button>'
                                                        : '<i class="uk-text-muted">Не е наличен</i>')
                                                    + '</div>'
                                                +'</div>'
                                            +'</a>'
                                            +'</div>';
                                        });
                                    }else{
                                        content += '<div class="uk-text-muted uk-text-large"><i class="uk-icon-warning"></i> Няма намерени продукти</div>';
                                    }
                                    $("#products").hide().html(content).fadeIn();
                                });
                            }    
                        </script>
                    </div>
                    <a class="uk-button uk-button-primary uk-text-nowrap uk-button-large  uk-width-small-2-10 uk-width-medium-1-10"><i class="uk-icon-search"></i></a>
                </div>
                
            </div>
        </form>
        
        <h2 data-lang>Резултати от търсенето</h2>
        
        <div id="products" class="uk-grid uk-container-center">
            <div class="uk-text-muted uk-text-large"><i class="uk-icon-warning"></i> Няма намерени продукти</div>
        </div>
        
        <script>
        /*
        function initProducts(){
            url = decodeURIComponent(window.location).split("/");
            id = parseInt(url[ url.length-2 ].split("-")[0], 10);
            $.getJSON("<?=URL_BASE?>ajax.php?f=products/getCategories&id="+id).done(function(ret){
                
                $("#products").html("").hide();
                if(ret.data.length == 0){
                    $("#products").html('<span class="uk-text-warning">В тази категория няма налични продукти</span>');
                }else {
                    $.each(ret.data, function(r,p){
                        $("#products").append(''
                            +'<div class="uk-margin uk-margin-top">'
                            +'<a class="uk-thumbnail uk-thumbnail-small" href="<?=URL_BASE.URL_PRODUCT?>'+(p.url_rewrite?p.url_rewrite:'/')+p.id+'-'+p.title.replace(/\ /g,"-")+'/">'
                                +'<img src="<?=URL_BASE?>image.php/'+p.id_image+'/thumb/'+p.date_add+'" alt="">'
                                +'<div class="uk-thumbnail-caption uk-text-right" style="height:9em">'
                                    +'<div class="uk-text-bold uk-text-left  uk-margin-bottom uk-margin-top uk-margin-left uk-overflow-hidden" style="line-height:1.25em;height:2.5em">'+p.title+'</div>'
                                    +'<div class="uk-text-large uk-text-bold uk-text-primary  uk-margin-left" style="font-size:1.5em">'
                                        +'<span class="">'+(parseFloat(p.price)).toFixed(2)+' лв</span>'
                                    +'</div>'
                                    +'<div>'
                                        +'<div class="">'
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
        */
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
        <?php include '../../snipps/featured.php';?>
            
            
        <br><br>
        <?php include '../../snipps/foot.php'; ?>
        <script src="<?=URL_BASE?>js/application.js"></script>
    </body>
    
</html>