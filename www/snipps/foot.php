        </div>
        <!-- footer -->
        
        <div class="uk-block uk-block-secondary uk-contrast">
            <div class="uk-container uk-container-center ">

                <div class="uk-grid uk-grid-match" data-uk-grid-margin="">
                    <div class="uk-width-medium-1-3 uk-row-first">
                        <div class="uk-panel">
                            <h3>Конткти</h3>
                            <p><a href="mailto:<?=$_COMPANY['email']?>" target="email"><i class="uk-icon-envelope"></i> <?=$_COMPANY['email']?></a></p>
                            <p><a href="https://skype.com/<?=$_COMPANY['skype']?>" target="skype"><i class="uk-icon-skype"></i> <?=$_COMPANY['skype']?></a></p>
                            <p><a href="https://facebook.com/<?=$_COMPANY['facebook']?>" target="facebook"><i class="uk-icon-facebook"></i> <?=$_COMPANY['facebook']?></a></p>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3">
                        <div class="uk-panel">
                            <h3>Информация</h3>
                            <p><a href="<?=URL_BASE?>contacts/">Contacts</a></p>
                            <?php foreach( explode(";",$_COMPANY['phone']) AS $phone){ ?>
                                <p><a href="call:<?=$phone?>" target="phone"><i class="uk-icon-phone"></i> <?=$phone?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3">
                        <div class="uk-panel">
                            <br><h1><?=$_COMPANY['name']?></h1>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- //footer -->
        
        <?php include __DIR__.'/../cart/modal.php';?>
        <?php include __DIR__.'/../cart/changing_script.php';?>

        <?php include __DIR__.'/ganalytics.php';?>