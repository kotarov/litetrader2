<?php 
    $dbh = new PDO('sqlite:'.DB_DIR.'products');
    $featured = $dbh->query("SELECT 
            a.id, a.title, a.description, a.price, a.url_rewrite, i.id image_id, i.date_add image_date
        FROM items a
        LEFT JOIN images i ON (i.id_item = a.id AND i.is_cover = 1 ) 
        WHERE a.is_avaible=1 AND a.is_visible=1 AND a.is_advertise=1
        ORDER BY a.id DESC LIMIT 20")
    ->fetchAll(PDO::FETCH_ASSOC);
    if(!$featured) return;
?>
   
            <hr>
            <h2 class="uk-responsive-width uk-text-left" data-lang>Избрани продукти</h2>
            
            <div class="uk-margin" id="featured" data-uk-slideset="{medium: 4}">    
                <div class="uk-slidenav-position uk-margin">
                    <ul id="featured-content" class="uk-slideset uk-grid uk-flex-center uk-grid-width-1-1 uk-grid-width-large-1-5 uk-grid-width-medium-1-4 uk-grid-width-small-1-2">
                       
                    <?php foreach ($featured AS $n=>$f){ ?>
                           
                       <li style="" class="uk-active"><a class="uk-thumbnail uk-overlay-hover" href="<?=URL_BASE?>products/view/index.php/<?=$f['url_rewrite']?>/">
                           <figure class="uk-overlay">  
                               <img src="<?=URL_BASE?>image.php/<?=$f['image_id'].'/thumb/'.$f['image_date']?>" alt="<?=$f['title']?>">  
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
            
 
    <script>
        UIkit.slideset("#featured", { "large":5, "medium":4, "small":2, "autoplay": true });
    </script>
    
    
    
    
    
    

<?php /*
<!-- featured -->
<hr>
<h2>Featured</h2>
<div class="uk-margin" id="featured" data-uk-slideset1="{medium: 4}">
    <div class="uk-slidenav-position uk-margin">
        <ul id="featured-content" class="uk-slideset uk-grid uk-flex-center"></ul>
        <a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideset-item="previous"></a>
        <a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideset-item="next"></a>
    </div>
    <ul class="uk-slideset-nav uk-dotnav uk-flex-center"></ul>
</div>
<script>
    $.getJSON("<?=URL_BASE?>ajax.php?f=getFeatured",function(featured){
        $.each(featured.data, function(k,v){ 
            var item = '<a class="uk-thumbnail uk-overlay-hover" href="<?=URL_BASE.URL_PRODUCT?>'+v.url_rewrite+'">'
            +'  <figure class="uk-overlay">'
            +'      <img src="<?=URL_BASE?>image.php/'+v.img+'/small/'+v.date_add+'" alt="'+v.alt+'">'
            +'      <div class="uk-overlay-panel uk-overlay-background uk-overlay-bottom uk-overlay-slide-bottom">'+v.price+'</div>'
            +'  </figure>'
            +'  <div class="uk-thumbnail-caption">'+v.title+'</div>'
            +'</a>';
            $("#featured-content").append('<li>'+item+'</li>');
        });
        UIkit.slideset("#featured", { "large":5, "medium":4, "small":2, "autoplay": true });
    });
</script>
<!-- //featured -->
*/?>