<?php 
include '../../snipps/init.php';

session_start();
if(isset($_GET['post']) && isset($_SESSION['cart']) && isset($_SESSION['order'])){
    $save = include DIR_BASE.'ajax/www/orders/postOrder.php';
    $_GET = $save['order'];
    if(isset($save['success'])) $message = true;
}

if(isset($_SESSION['customer'])){
    header("Location: ".URL_BASE."customer/profile.php");
}

$get = filter_var_array($_GET,array(
    'id'=>FILTER_VALIDATE_INT,
    'email'=>FILTER_SANITIZE_EMAIL,
    'phone'=>FILTER_SANITIZE_STRING,
    'date_add'=>FILTER_SANITIZE_STRING
));

?>
<!DOCTYPE html>
<html class="uk-height-1-1">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product</title>
        <link rel="shortcut icon" href="<?=URL_BASE?>img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" href="<?=URL_BASE?>img/apple-touch-icon.png">
        
        <script src="<?=$_ASSETS['jquery.js']?>"></script>

        <link  href="<?=$_ASSETS['uikit.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.js']?>"></script>
        <script src="<?=$_ASSETS['uikit.offcanvas.js']?>"></script>
        <link  href="<?=$_ASSETS['uikit.notify.css']?>" rel="stylesheet"/>
        <script src="<?=$_ASSETS['uikit.notify.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.dotnav.css']?>" />
        <script src="<?=$_ASSETS['uikit.slideset.js']?>"></script>

        <link rel="stylesheet" href="<?=$_ASSETS['uikit.autocomplete.css']?>">
        <script src="<?=$_ASSETS['uikit.autocomplete.js']?>"></script>
        <link rel="stylesheet" href="<?=$_ASSETS['uikit.search.css']?>">
        <script src="<?=$_ASSETS['uikit.search.js']?>"></script>
        <link href="<?=$_ASSETS['uikit.form.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.form.js']?>"></script>
        <link href="<?=$_ASSETS['uikit.datepicker.css']?>" rel="stylesheet" />
        <script src="<?=$_ASSETS['uikit.datepicker.js']?>"></script>
        
        
        <link href="<?=URL_BASE?>css/theme.css" rel="stylesheet">
        
        <link  href="<?=$_ASSETS['dataTables.uikit.css']?>" rel="stylesheet">
        <script src="<?=$_ASSETS['dataTables.js']?>"></script>
        <script src="<?=$_ASSETS['dataTables.uikit.js']?>"></script>
        
        <style>
            .cart-depends { display:none;}
        </style>
    </head>
    
    <body id="page-orderview"> 
        <?php include '../../snipps/head.php'; ?>
        <?php if(isset($message) && $message){ ?>
            <div class="uk-panel uk-panel-box uk-alert-success" data-uk-alert>
                <p>Успешно пуснахте заявка с номер №<b><?=$save['order']['id']?></b> !</p>
            </div>
        <?php }?>
        
        <h1 data-lang>Преглед на заявка</h1>
        
        <br>
        <form id="form-order-view" action="<?=URL_BASE?>ajax.php?f=orders/getOrder" class="uk-form uk-form-horizontal uk-width-large-2-4 uk-wdth-medium-1-3">
            <div class="uk-form-row">
                <label class="uk-form-label">Email</label>
                <div class="uk-form-controls"><input name="email" class="uk-width-1-1" value="<?=$get['email']?>"></div>
            </div>
            
            <div class="uk-form-row">
                <label class="uk-form-label">Номер</label>
                <div class="uk-form-controls"><input  type="text" class="uk-width-1-1" name="id" value="<?=$get['id']?>" ></div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">Дата</label>
                <div class="uk-form-controls"><input  type="text" class="uk-width-1-1" data-uk-datepicker="{format:'DD.MM.YYYY'}" name="date_add" placeholder="__.__.____" value="<?=$get['date_add']?>" ></div>
            </div>
            
            <div class="uk-form-row">
                <label class="uk-form-label"></label>
                <div class="uk-form-controls">
                    <button type="submit" id="button-submit-check" class="uk-button uk-button-primary" name="check">Провери</button>
                </div>
            </div>
        </form>

        <div id="order-details">
            <div id="no-order-template" style="display:none">
                <br><br>
                <div class="uk-panel uk-panel-box uk-panel-box-primary">Не е открита заявка</div>
            </div>
            <div id="order-template" style="display:none">
                    <br><br><br>
                    <div class="uk-modal-header"><h1 data-lang>Данни на заявка № <span name="id"></span> от <span name="date_add"></span></h1></div>
                        
                    <table class="uk-table uk-margin-small-bottom">
                        <tr style="border-bottom:1px dotted #ccc;border-top:1px dotted #ccc"><td class="uk-width-1-4">История:</td><td><span name="status"></span></td></tr>
                        <?php /*<tr><td>Дата:</td><th><span name="date_add"></span></th></tr> */?>
                    </table>
                    <div class="uk-panel uk-panel-box">
                    <table class="uk-table uk-table-striped1 uk-table-condensed">
                        <tr><td class="uk-width-1-4">Имена</td><td class="uk-text-bold" class="uk-width-1-1" name="customer"></td></tr>
                        <tr><td class="">Телефон</td><td class="uk-text-bold" name="phone"></td></tr>
                        <tr><td class="">Email</td><td class="uk-text-bold" name="email"></td></tr>
                        <tr><td class="">Адрес</td><td class="uk-text-bold" name="address"></td></tr>
                    </table>
                    </div>
                    
                    <div class="uk-margin-top" style="overflow-x:auto">
                    <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed" id="order-summary-products">
                        <thead><tr>
                            <th class="uk-text-center">№</th><th>Продукт</th><th class="uk-text-right">Цена</th><th class="uk-text-center">Кол.</th><th class="uk-text-right">Сума</th>
                        </tr></thead>
                        <tbody style="border-top:1px solid #ccc;border-bottom:1px solid #ccc"></tbody>
                        <tfoot><tr>
                            <tr><td colspan="4" class="uk-text-right">Продукти</td><td class="uk-text-right" name="sum"></td></tr>
                            <tr><td colspan="4" class="uk-text-right"><span name="tax"></span></td><td class="uk-text-right" name="tax_price"></td></tr>
                            <tr><td colspan="4" class="uk-text-right"><span name="delivery_method"></span></td><td class="uk-text-right" name="delivery_price"></td></tr>
                            <tr style="border-top:1px solid #ccc"><th colspan="4" class="uk-text-right">ВСИЧКО</th><th class="uk-text-right uk-text-large uk-text-bold" name="total"></th></tr> 
                        </tr></tfoot>
                    </table>
                    </div>
                    
                    <div class="uk-text-center uk-panel uk-panel-box">
                        <span>Начин на плащане</span>: <span class="uk-text-bold" name="payment_method"></span>
                    </div>
            </div>
        </div>
        
        <script>
            $("#form-order-view").on("after-submit", function(e,ret){
                if(!ret.data) {
                    $("#no-order-template").hide().fadeIn();
                    $("#order-template").hide();
                }else {
                    displayOrder(ret);
                }        
            });
            function displayOrder(data){
                $("#no-order-template").hide();
                $("#order-template").hide().fadeIn();
                $.each(data.data, function(f,v){
                    if(f =='tax_price' || f == 'delivery_price'){
                        if(parseFloat(v) == 0 || !v) v = '-';
                    }
                    if(f=='id') v = '000'+v;
                    $("#order-details").find("[name="+f+"]").html(v);
                });

                var statuses = '<table class="uk-table uk-table-condensed uk-margin-remove" style="padding:0">';
                $.each(data.statuses, function(k,v){
                    statuses += '<tr><td>'+v.status+'</td><td>'+v.date_add+'</td><td>'+v.user+'</td></tr>';
                })
                statuses += "</table>";
                $("#order-details").find("[name=status]").html(statuses);
                
                var cart ='';
                var n = 1;
                $.each(data.cart, function(k,v){
                    cart += '<tr>'
                        +'<td class="uk-text-center">'+(n++)+'</td>'
                        +'<td>'+v.item+(v.note ? ' <span class="uk-text-muted">('+v.note+')</span>' : '')+'</td>'
                        +'<td class="uk-text-right">'+parseFloat(v.price).toFixed(2)+'</td>'
                        +'<td class="uk-text-center">'+v.qty+'</td>'
                        +'<td class="uk-text-right uk-text-bold">'+(v.qty*v.price).toFixed(2)+'</td>'
                    +'</tr>';
                });
                $("#order-summary-products > tbody").html(cart);
                
                $("#order-details").find("[name=sum]").html(data.sum);
                $("#order-details").find("[name=total]").html(data.total);
            }
        </script>
        
        
        
    
        <div class="uk-margin-large-bottom"></div>
        <script src="<?=URL_BASE?>js/application.js"></script>
            <?php if(isset($message) && $message){ ?>
               <script> $(function(){ $("#button-submit-check").click();}); </script>
            <?php } ?>

        <?php include '../../snipps/foot.php'; ?>
    </body>
</html>