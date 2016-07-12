<?php include '../snipps/init.php'; ?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>
        
        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        
        <style type="text/css">
            @media (min-width: 768px){.left-menu-hat { border-right: 1px solid #ddd; } }
            table.cart { border:1px solid; background:#fff;}
            table.cart thead tr th { background: #333;color:#fff;}
            table.cart tfoot tr th { background: #fafafa;}
            table.dataTable tbody { border-top:1px solid #ddd; border-bottom:1px solid #ddd;}
        </style>
        <script>
            var lang = {
                'Profile updated':'Профила е променен'
            };
        </script>
    </head>
    <body id="page-profile"> 
        <?php include '../snipps/head.php'; ?>
        <div class="uk-grid uk-margin">
            
            <div class="uk-width-medium-2-10">
                <div class="uk-text-center left-menu-hat">
                    <i class="uk-icon-user uk-border-circle uk-margin-bottom" style="font-size:6em;padding:0.1em 0.2em;background:#f5f5f5;color:#fff"></i>
                    <div id="personal-email" class="uk-text-muted" style="padding-bottom:1em"></div>
                </div>
                <ul class="uk-tab uk-tab-left" data-uk-tab="{connect:'#tab-content'}" >
                    <li  class="uk-active"><a href="#active-orders" data-lang>Нови заявки</a></li>
                    <li><a href="#done-orders" data-lang>Приключили заявки</a></li>
                    <li><a href="#canceled-orders" data-lang>Отказани заявки</a></li>
                    <li><a href="#profile"><i class="uk-icon-cog"></i> Данни</a></li>
                </ul>
                <div class="uk-hidden-small" style="border-right:1px solid #ddd">
                    <br><br><br><br><br><br><br><br><br>
                </div>
            </div>
            
            
            <div class="uk-width-medium-8-10 uk-margin">
                <ul class="uk-switcher" id="tab-content">
                    
                    <li id="active-orders"> 
                        <h2 data-lang>Активни заявки</h2> 
                        <div class="uk-overflow-container">
                        <?php 
                            $url = URL_BASE.'ajax.php?f=customer/getOrders&t=active';
                            include __DIR__.'/_order_table.php';
                        ?>
                        </div>
                    </li>
                    <li id="done-orders">
                        <h2 data-lang>Приключили заявки</h2>
                        <div class="uk-overflow-container">
                        <?php 
                            $url = URL_BASE.'ajax.php?f=customer/getOrders&t=done';
                            include __DIR__.'/_order_table.php';
                        ?>
                        </div>
                    </li>
                    <li id="canceled-orders">
                        <h2 data-lang>Отказани заявки</h2>
                        <div class="uk-overflow-container">
                        <?php 
                            $url = URL_BASE.'ajax.php?f=customer/getOrders&t=canceled';
                            include __DIR__.'/_order_table.php';
                        ?>
                        </div>
                    </li>
                    
                    
                    <li id="profile">
                        <form id="form-profile" class="uk-form" action="<?=URL_BASE?>ajax.php?f=customer/postUpdateProfile" method="post" data-trigger="profile-changed">
                            <h2 data-lang>Данни на профила</h2>
                            <dl id="personal-summary" class="uk-description-list uk-description-list-line uk-width-medium-1-2">
                                <dt data-lang>Име</dt>
                                <dd id="personal-name" class="uk-visible-hover-inline">-</dd>
    
                                <dt data-lang>Фамилия</dt>
                                <dd id="personal-family" class="uk-visible-hover-inline">-</dd>
    
                                
                                <dt data-lang>Телефон</dt>
                                <dd id="personal-phone" class="uk-visible-hover-inline">-</dd>
                                
                                
                                <dt data-lang>Skype</dt>
                                <dd id="personal-skype" class="uk-visible-hover-inline">-</dd>
                                
                                <dt data-lang>Facebook</dt>
                                <dd id="personal-facebook" class="uk-visible-hover-inline">-</dd>
                                
                                <dt data-lang>Tweeter</dt>
                                <dd id="personal-twitter" class="uk-visible-hover-inline">-</dd>
                                
                                <dt data-lang>Град</dt>
                                <dd id="personal-city" class="uk-visible-hover-inline">-</dd>
                                
                                <dt data-lang>Адрес</dt>
                                <dd id="personal-address" class="uk-visible-hover-inline">-</dd>
                                
                                <dt data-lang>Парола</dt>
                                <dd id="personal-password" class="uk-visible-hover-inline">-</dd>
                            </dl>
                            <button id="submit-change-personal-data" type="submit" class="uk-button uk-button-primary uk-hidden" data-lang>Запиши</button>
                            <button id="reset-change-personal-data" type="reset" class="uk-button uk-hidden" data-lang>Нулиране</button>
                        </form>
                        <script>
                            
                            $(document).on("profile-changed",function(e,ret){
                                $(this).find("input").remove();
                                fillProfile();
                                $("#submit-change-personal-data").addClass("uk-hidden");
                                $("#reset-change-personal-data").addClass("uk-hidden");
                            });
                        
                            function fillProfile(){
                                $.getJSON("<?=URL_BASE?>ajax.php?f=getLogged").done(function(d){ 
                                    if(d.id){
                                        var icon = ' <a class="uk-hidden uk-icon-pencil uk-float-right"></a>';
                                        $("#personal-name").html(d.name + "&nbsp;" +icon);
                                        $("#personal-family").html(d.family + "&nbsp;" +icon);
                                        $("#personal-phone").html(d.phone + "&nbsp;" + icon);
                                        $("#personal-skype").html(d.skype + "&nbsp;" + icon);
                                        $("#personal-facebook").html(d.facebook + "&nbsp;" + icon);
                                        $("#personal-twitter").html(d.twitter + "&nbsp;" + icon);
                                        $("#personal-email").html("<span class='uk-text-bold'>"+d.email.replace("@","</span> <span>@") + "</span>");
                                        $("#personal-city").html(d.city + "&nbsp;" +icon)
                                        $("#personal-address").html(d.address + "&nbsp;" +icon);
                                        $("#personal-password").html("*****" + "&nbsp;" +icon);
                                    }else{
                                        window.location.href = "<?=URL_BASE?>customer/";
                                    }     
                                });
                            };
                            fillProfile();
                            
                            $("#personal-summary").on("click", ".uk-icon-pencil", function(e){
                                e.preventDefault();
                                var oldval = $.trim( $(this).parent().text() );
                                var name = $(this).parent().attr("id");
                                if(name == "personal-password"){
                                    $(this).parent().html('<input type="password" class="uk-width-1-1" name="password">');
                                }else{
                                    $(this).parent().html('<input type="text" class="uk-width-1-1" name="'+name.substring(9)+'" value="'+oldval+'">');
                                }
                                $("#submit-change-personal-data").removeClass("uk-hidden");
                                $("#reset-change-personal-data").removeClass("uk-hidden");
                            });
                            
                        </script>
                    </li>
                </ul>
            </div>
            
            <script>
                var users_carts = {};
                $("table").on("click","[data-cart]", function(k,v){
                    var id = $(this).attr("data-cart") ;
                    var tr = $(this).closest("tr");
                    
                    if(typeof users_carts[ id ] == "object"){
                        toggleCartAfterOrder( tr, users_carts[ id ] ); 
                    }else $.getJSON("<?=URL_BASE?>ajax.php?f=customer/getOrderCart&id_order="+id).done(function(ret){
                        users_carts[ id ] = ret;
                        toggleCartAfterOrder( tr, ret );
                    });
                });
                function toggleCartAfterOrder(r,d){
                    if( $(r).next().hasClass(d['id']+"_cart") ){
                        $(r).next().fadeOut(300,function(){$(this).remove()});
                    }else{
                        var c = '<table class="cart uk-table uk-table-condensed" width="100%"><thead><tr>'
                                +'<th>№</th><th>'+(lang['Продукт']||'Продукт')+'</th> <th class="uk-text-right">'+(lang['Кол.']||'Кол.')+'</th> <th class="uk-text-center">'+"МЕ"+'</th> <th class="uk-text-right">'+"Цена"+'</th> <th class="uk-text-right">'+"Всичко"+"</th>"
                            +'</tr></thead><tbody>';
                        var sum = 0;
                        var n = 1;
                        $.each(d.data, function(k,v){
                            c += "<tr>"
                                +'<td>'+(n++)+'</td>'
                                +"<td>"+v['item']+(v.note.length > 0 ? ' <span class="uk-text-muted">('+v.note+")</span>":"")+"</td>"
                                +"<td class='uk-text-right'>"+v['qty']+"</td>"
                                +"<td class='uk-text-center'>"+v['unit']+"</td>"
                                +"<td class='uk-text-right'>"+parseFloat(v['price']).toFixed(2,10)+"</td>"
                                +"<td class='uk-text-right'>"+(v['qty']*v['price']).toFixed(2,10)+"</td>"
                            +"</tr>";
                            sum += v['qty']*v['price'];
                        });
                        c += "</tbody><tfoot>"
                            +"<tr>"
                                +'<td colspan="5" class="uk-text-right">Сума продукти:</td>'
                                +'<td class="uk-text-right uk-text-primary">'+parseFloat(sum).toFixed(2,10)+"</td>"
                            +"</tr>"
                            +"<tr>"
                                +'<td colspan="5" class="uk-text-right">'+d.order[0].tax+':</td>'
                                +'<td class="uk-text-right uk-text-primary">'+(d.order[0].tax_price>0 ? parseFloat(d.order[0].tax_price).toFixed(2,10) : '-')+"</td>"
                            +"</tr>"
                            +"<tr>"
                                +'<td colspan="5" class="uk-text-right">'+d.order[0].delivery_method+':</td>'
                                +'<td class="uk-text-right uk-text-primary">'+(d.order[0].delivery_price >0 ? parseFloat(d.order[0].delivery_price).toFixed(2,10) : '-')+"</td>"
                            +"</tr>"
                            +"<tr>"
                                +'<th colspan="5" class="uk-text-right uk-text-primary">Всичко:</th>'
                                +'<th class="uk-text-right uk-text-primary">'+parseFloat(d.order[0].total).toFixed(2,10)+"</th>"
                            +"</tr>"
                        +"</tfoot></table>"
                        
                        $(r).after('<tr class="'+d['id']+'_cart" style="display:none"><td></td> <td colspan="8">'+c+'</td></tr>');
                        $("."+d['id']+'_cart').fadeIn();
                    }
                }
            </script>
            
        </div>
        <?php include '../snipps/foot.php'; ?>
        <script src="<?=$_ASSETS['application.js']?>"></script>
    </body>
</html>