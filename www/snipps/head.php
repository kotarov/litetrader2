<?php 

$NO_ENCODE = true;

?>
<?php /*<div class="uk-block-secondary uk-contrast"> <p class="uk-container uk-container-center "> <a>We use cookies</a></p> </div> */?>

        <div class="uk-container uk-container-center uk-margin-large-bottom">
            <div class="uk-panel uk-margin-top">
                <div class="uk-float-left"><h1><?=$_COMPANY['name']?></h1></div>
                <div class="uk-navbar-content uk-hidden-small ">
                    <!-- Search -->
                    <form class="uk-search no-ajax" id="menu-search-form" action="<?=URL_BASE?>products/search/index.php" 
                        data-uk-search="{source:'<?=URL_BASE?>ajax.php?f=products/search', msgResultsHeader:'Намерени резултати',msgMoreResults:'Още резултати...',msgNoResults:'Няма намерени резултати'}"
                    >
                        <input class="uk-search-field uk-text-primary" id="menu-search-input" type="search" placeholder="search..." autocomplete="off">
                        <a href="<?=URL_BASE?>products/search" class="uk-button uk-button-primary" style="display:none;z-index:0;position:absolute;left:100%;top:0;" id="menu-search-button"><i class="uk-icon-search"></i></a>
                    </form>
                    
                    <script>
                        $("#menu-search-input").focus(function(e){ $("#menu-search-button").fadeIn();$("#menu-search-input");});
                        $("#menu-search-form").focusout(function(e){ $("#menu-search-button").fadeOut();});
                    </script>
                    <!-- /Search -->
                </div>

                

                <!-- Shopping cart -->
                <div class="uk-float-right uk-hidden-small">
                    <div id="shopping-cart" class="uk-grid" style="min-width:13em" hidden>
                        <div class="uk-width-2-6 uk-text-large shopping-cart-icon">
                            <a href="#modal-cart" data-uk-modal><i class="uk-icon-shopping-bag uk-text-primary" style="position:relative">
                                <span style="position:absolute;margin-top:-1em;margin-left:2em;display:none" class="shopping-cart-badge uk-badge uk-badge-notification uk-badge-danger">0</span>
                            </i></a>
                        </div>
                        <div class="uk-width-4-6 uk-text-right">
                            <div class="uk-text-muted uk-text-nowrap" data-lang>Пазарска кошница</div>
                            <span class="uk-text-primary uk-text-bold uk-text-large shopping-cart-price" style="margin-top:0;display:none">0.00</span>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).on("shopping-cart-changed", function(e, cart){
                        if(cart.nb > 0){
                            $(".shopping-cart-badge").html(cart.nb).show();
                            $(".shopping-cart-price").html(cart.total.toFixed(2)).show();
                        }else{
                            $(".shopping-cart-badge").html("").hide();
                            $(".shopping-cart-price").html("").hide();
                        }
                    });
                </script>
                <!-- //shopping cart -->
                
                <!-- Phone --> 
                <h2 class="uk-margin-small-top uk-float-right uk-margin-small-bottom uk-margin-large-right uk-align-right uk-text-middle uk-grid uk-hidden-small uk-hidden-medium">
                    <span class="uk-panel uk-text-center"><i class="uk-icon-phone"></i></span> 
                    <span class="uk-text-left uk-panel" <?=(substr_count($_COMPANY['phone'],";")?'style="margin-top:-0.5em"':'')?>><?=str_replace(";","<br>",$_COMPANY['phone'])?></span>
                </h2>
                <h2 class="uk-hidden-large uk-margin-bottom uk-text-left uk-margin-small-top" style="clear:both">
                    <span class="uk-panel"><i class="uk-icon-phone"></i> <?=$_COMPANY['phone']?></span>                    
                </h2>
                <!-- //Phone -->
                
            </div>

            <?php include __DIR__.'/menu.php';?>
