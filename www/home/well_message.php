 <?php
    $well = parse_ini_file(INI_DIR.'www/well_message.ini',true);
 ?>
 
 <!-- Well -->
            <br>
            <div class="uk-grid uk-margin-top" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1 uk-row-first">
                    <div class="uk-panel uk-panel-box uk-text-center">
                        <p>
                            <?=$well['bold']?'<strong>'.$well['bold'].'</strong>':''?> 
                            <?=$well['normal']?$well['normal']:'';?> 
                            <?=$well['button']?'<a class="uk-button uk-button-primary uk-margin-left" href="#">'.$well['button'].'</a>':''?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- //well -->