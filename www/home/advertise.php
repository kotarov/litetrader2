<?php
    $advertises = parse_ini_file(INI_DIR.'www/advertise.ini',true);
?>
<!-- Advertise -->
            <div class="uk-grid" data-uk-grid-margin>
                <?php foreach($advertises AS $n=>$adv ) { ?>
                
                <div class="uk-width-medium-1-3">
                    <div class="uk-grid">
                        <div class="uk-width-1-6">
                            <i class="<?=$adv['icon']?> uk-icon-large uk-text-primary"></i>
                        </div>
                        <div class="uk-width-5-6">
                            <h2 class="uk-h3"><?=$adv['title']?></h2>
                            <p><?=$adv['text']?></p>
                        </div>
                    </div>
                </div>

                <?php } ?>
            </div>
            
            <!-- //Advertize -->