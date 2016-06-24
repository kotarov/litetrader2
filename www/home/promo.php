<?php 
    $dbh = new PDO('sqlite:'.DB_DIR.'products');
    $promos = $dbh->query("SELECT 
            a.id, a.title, a.description, a.price, a.url_rewrite, i.id image_id, i.date_add image_date
        FROM items a
        LEFT JOIN images i ON (i.id_item = a.id AND i.is_cover = 1 ) 
        WHERE a.is_avaible=1 AND a.is_visible=1 AND a.is_advertise=1")
    ->fetchAll(PDO::FETCH_ASSOC);
    if(!$promos) return;
?>
    <div class="uk-width-medium-1-1 uk-panel uk-panel-box uk-vertical-align " style="margin-bottom:30px">
       <div class="uk-text-center uk-vertical-align-middle uk-width-1-1">
           <div class="uk-vertical-align-middle uk-width-1-1">
                <h2 class="uk-responsive-width uk-text-left" data-lang>Избрани продукти</h2>
            
            <div class="uk-margin" id="promotions" data-uk-slideset="{medium: 4}">    
                <div class="uk-slidenav-position uk-margin">
                    <ul id="promo-content" class="uk-slideset uk-grid uk-flex-center uk-grid-width-1-1 uk-grid-width-large-1-5 uk-grid-width-medium-1-4 uk-grid-width-small-1-2">
                       
                    <?php foreach ($promos AS $n=>$f){ ?>
                           
                       <li style="" class="uk-active"><a class="uk-thumbnail uk-overlay-hover" href="<?=URL_BASE?>products/view/index.php/<?=$f['url_rewrite']?>/">
                           <figure class="uk-overlay">  
                               <img src="<?=URL_BASE?>image.php/<?=$f['image_id'].'/small/'.$f['image_date']?>" alt="<?=$f['title']?>">  
                               <div class="uk-overlay-panel uk-overlay-background uk-overlay-bottom uk-overlay-slide-bottom">10.0</div>
                            </figure>  
                            <div class="uk-thumbnail-caption"><?=$f['title']?></div>
                        </a></li>
                    
                    <?php } ?>
                    
                    </ul>
                    <a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideset-item="previous"></a>
                    <a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideset-item="next"></a>
            </div>
            <ul class="uk-slideset-nav uk-dotnav uk-flex-center"></ul>
        </div>
            
           </div>
        </div>
    </div>
    <script>
        UIkit.slideset("#promotions", { "large":5, "medium":4, "small":2, "autoplay": true });
    </script>