<?php
$me = parse_ini_file(INI_DIR.'www/menus.ini', true); $me = $me['public'];
?>

<!-- menu -->
<nav class="uk-navbar main-navbar uk-margin-bottom">
    <ul class="uk-navbar-nav uk-hidden-small">
        <?php if($me['home']) { ?>
        <li data-active="page-home">
            <a href="<?=URL_BASE?>home/"><i class="uk-icon-home"></i> <?=$me['home_title']?></a>
        </li>
        <?php } ?>

        <?php if($me['products']) { 
                if($me['products']) $menu = include __DIR__.'/../../ajax/www/getMenu.php';
        ?>
        <style>
            #category-menu{margin:auto!important;left:-3em!important;min-width:650px;}
        </style>
        <li data-active="page-products" data-uk-dropdown>
            <a href="<?=URL_BASE?>products/" class="uk-button-dropdown" aria-haspopup="true" data-uk-dropdown="" aria-expanded="false" ><?=$me['products_title']?></a>
            <div id="category-menu" class="uk-dropdown uk-dropdown-width-4 uk-dropdown-bottom uk-dropdown-stack uk-grid" style="background:#eee;">
                    <ul class="uk-nav uk-nav-side uk-width-1-3" >
                        
                        <?php foreach($menu['data'] AS $r=>$m){ if($m['depth'] == 1) { ?>
                            <li class="uk-parent" data-menu-hover="<?=$m['id']?>">
                                <a class="uk-text-primary" href="<?=URL_BASE.'products/index.php'.$m['url_rewrite']?>">
                                    <?=$m['title']?>
                                    <?php /*<?=$m['subtitle']?'<div class="uk-text-muted">'.$m['subtitle'].'</div>':''?> */?>
                                </a>
                            </li>
                        <?php } } ?>
                        
                        <li class="uk-nav-divider"></li>
                        <li><a class="uk-text-muted" href="<?=URL_BASE?>products/search/index.php"><i class="uk-icon-search"></i> Търси по критерий ...</a></li>
                        
                    </ul>
                    
                    <div class="uk-width-2-3" style="margin-left:15px; ">
                        <div class="menu-hover" style="margin-left:15px;">
                            <h3 class="uk-panel-titleuk-text-right">
                                <div class="uk-text-large"><?=$_COMPANY['name']?> &trade;</div>
                                <div class="uk-text-muted uk-text-small">Категории</div>
                            </h3>
                        </div>
                    <?php foreach($menu['data'] AS $r=>$m){ if($m['depth']==1) { ?>
                        <div class="menu-hover menu-hover-<?=$m['id']?>" style="margin-left:15px;display:none"> 
                        <div class="uk-panel uk-panel-header uk-panel-divider">
                             
                            <div class="uk-panel-teaser">
                                <img src="<?=URL_BASE.'imageCategory.php/'.$m['id'].'/thumb';?>" class="uk-width-1-1">
                            </div> 
                            <h3 class="uk-panel-title">
                                <?=$m['title'];?>
                                <div class="uk-text-small uk-text-muted"><?=$m['subtitle']?></div>
                            </h3>
                            
                           
                            
                            <div class="uk-width-1-1 ">
                            <?php foreach($menu['data'] AS $rr=>$mm) { if($mm['id_parent'] == $m['id']) { ?>
                                <div class="uk-width-1-3 uk-margin-bottom uk-float-left">
                                    <a href="<?=URL_BASE.'products/index.php'.$mm['url_rewrite']?>" class="uk-text-primary"><?=$mm['title']?></a>
                                    <?php foreach($menu['data'] AS $rrr=>$mmm) { if($mmm['id_parent'] == $mm['id']){ ?>
                                        <div class="uk-text-muted">&nbsp;&nbsp;<i class="uk-icon-caret-right"></i> <a href="<?=URL_BASE.'products/index.php'.$mmm['url_rewrite'];?>" class="uk-text-muted"><?=$mmm['title']?></a></div>    
                                    <?php }} ?>
                                </div>
                            <?php } } ?>
                            </div>
                         </div>
                         </div>
                    <?php } } ?>
                    </div>
            </div>
            <script>
                $("body").on("mouseover","[data-menu-hover]",function(){
                    $(".menu-hover").hide();
                    $(".menu-hover-"+$(this).data("menu-hover")).show();
                });
            </script>
        
        </li>
        <?php } ?>
        
        <?php if($me['articles']) { ?>
        <li data-active="page-articles">
            <a href="<?=URL_BASE?>articles/"><?=$me['articles_title']?></a>
        </li>
        <?php } ?>
        
        <?php if($me['contacts']) { ?>
        <li data-active="page-contacts">
            <a href="<?=URL_BASE?>contacts/"><?=$me['contacts_title']?></a>
        </li>
        <?php } ?>
        
        <?php if($me['order']) { ?>
        <li data-active="page-order" class="checkout" hidden>
            <a href="<?=URL_BASE?>order/"> <?=$me['order_title']?> <b class="shopping-cart-badge uk-badge uk-badge-notification uk-badge-danger"></b></a>
        </li>
        <?php } ?>
        
    </ul>
    
    
    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav uk-hidden-small customer-nav-menu">
            <li data-active="page-orderview"><a href="<?=URL_BASE?>order/view"><i class="uk-icon-"></i> Проследи заявка</a></li>
            
            <?php if($me['login']) { ?>
            <li data-active="page-profile"><a href="<?=URL_BASE?>customer/"><i class="uk-icon-user"></i> <?=$me['login_title']?></a></li>
            <?php } ?>
        </ul>
    </div>
    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
    <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
        <form class="uk-search uk-text-left no-ajax" action="<?=URL_BASE?>products/search/" data-uk-search="{source:'<?=URL_BASE?>ajax.php?f=products/search'}">
            <input class="uk-search-field" type="search" placeholder="search..." autocomplete="off">
        </form>
    </div>
</nav>

<div id="offcanvas" class="uk-offcanvas">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-show">
        <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
            <li class="uk-nav-divider"></li>

            <?php if($me['home']) { ?>
            <li data-active="page-home">
                <a href="<?=URL_BASE?>home/"><?=$me['home_title']?></a>
            </li>
            <?php } ?>

            <?php if($me['products']) { ?>
            <li data-active="page-category" class="uk-parent">
                <a href="#"><?=$me['products_title']?></a>
                <ul class="uk-nav-sub" >
                    <?php foreach($menu['data'] AS $k=>$m){ if($m['depth'] == 1) {?>
                        <li class="uk-margin-left">
                            <a class="uk-text-primary" href="<?=URL_BASE.'products'.$m['url_rewrite']?>"><?=$m['title']?></a>
                            <?php foreach($menu['data'] AS $kk=>$mm){ if($mm['depth'] == 2) { ?>
                                <a class="uk-margin-left" href="<?=URL_BASE.'products'.$mm['url_rewrite']?>"><?=$mm['title']?></a>
                            <?php } } ?>
                        </li>
                    <?php } } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if($me['articles']) { ?>
            <li data-active="page-articles">
                <a href="<?=URL_BASE?>articles/"><?=$me['articles_title']?></a>
            </li>
            <?php } ?>
            
            <?php if($me['contacts']) { ?>
            <li data-active="page-contacts">
                <a href="<?=URL_BASE?>contacts/"><?=$me['contacts_title']?></a>
            </li>
            <?php } ?>
            
            <?php if($me['order']) { ?>
            <li data-active="page-order" class="checkout">
                <a href="<?=URL_BASE?>order/"><?=$me['order_title']?> <b class="shopping-cart-badge uk-badge uk-badge-notification uk-badge-danger"></b></a>
            </li>
            <?php } ?>
            
            <li class="uk-nav-divider"></li>
            <?php if($me['login']) { ?>
            <li>
                <ul class="uk-nav customer-nav-menu">
                    <li><a href="<?=URL_BASE?>customer/"><?=$me['login_title']?></a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
 <script>
    $.getJSON("<?=URL_BASE?>ajax.php?f=getLogged").done(function(d){ if(d.id){
        var active = "";
        if($("body").attr("id") == "page-profile") active = ' class="uk-active"'
        $(".customer-nav-menu").html(''
            +'<li'+active+'><a href="<?=URL_BASE?>customer/profile.php"> '+ d.name+' '+ d.family +' </a></li>'
            +'<li><a onclick="$.get(\'<?=URL_BASE?>ajax.php?f=login/postLogout\').done(window.location.replace(\'<?=URL_BASE?>home/\'))"><i class="uk-icon-power-off"></i> Exit</a></li>'
        );
    }});
    $("[data-active='"+$("body").attr("id")+"']").addClass("uk-active");
</script>
<!-- //menu -->