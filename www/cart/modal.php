
        <div id="modal-cart" class="uk-modal">
            <div class="uk-modal-dialog"><a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"><h3 data-lang>Вашите продукти за поръчка</h3></div>
                <?php include __DIR__."/../cart/content.php";?>
                <div class="uk-modal-footer">
                    <button class="uk-button uk-modal-close uk-button-large" data-lang>Затвори</button>
                    <a href="<?=URL_BASE?>order/" class="uk-button uk-button-primary uk-button-large uk-float-right checkout"><i class="uk-icon-truck"></i> &nbsp; <span>Поръчай</span></a>
                </div>
            </div>
        </div>