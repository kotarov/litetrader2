<!-- slider -->
<?php $slider = parse_ini_file(INI_DIR."www/sliders.ini",true);?>
<div class="uk-margin-bottom">
    <div class="uk-width-medium-1-1">
        <div class="fotorama" data-loop="true" data-autoplay="true" style="position:relative" data-width="100%">
                <?php $sl = 'slide1'; foreach($slider[$sl]['src'] AS $k => $src){ ?>
                    <?php if($slider[$sl]['title'][$k] || $slider[$sl]['text'][$k]) 
                            $class="uk-text-center uk-overlay-background uk-overlay-panel uk-overlay-bottom"; 
                        else 
                            $class="uk-hidden"; 
                    ?>
                    
                    <div class="<?=$class?>" data-img="<?=URL_BASE?>img/slide/<?=$src?>"> 
                        <?php if($slider[$sl]['title'][$k]) { ?>
                            <h1 class=""> <?=$slider[$sl]['title'][$k]?> </h1>
                        <?php } ?>
                        <?php if($slider[$sl]['text'][$k]) { ?>
                            <h2 class=""> <?=$slider[$sl]['text'][$k]?>  </h2>
                        <?php } ?>
                    </div>
                <?php } ?>
        </div>
    </div>
</div>
<!-- //slider -->