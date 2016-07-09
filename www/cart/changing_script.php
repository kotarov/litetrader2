<script>
            $(document).on("shopping-cart-changed",function(e,cart){
                if(cart.nb){
                    $(".checkout").show();
                    $("table.shopping-cart-detailed").html('<thead clss="cart-header"><tr>'
                    +'  <th></th>'
                    +'  <th class="uk-text-left" data-lang>Продукт</th>'
                    +'  <th class="uk-text-center" data-lang>Цена</th>'
                    +'  <th class="uk-text-center" data-lang>МЕ</th>'
                    +'  <th class="uk-text-center" data-lang>Кол.</th>'
                    +'  <th class="uk-text-right" data-lang>Тотал &nbsp;</th>'
                    +'</tr></thead>'
                    +'<tbody></tbody>'
                    +'<tfoot class="cart-footer">'
                    +(cart.tax.value > 0 ? 
                        '  <tr class="cart-tax-row"><td colspan="5" class="uk-text-right"> '+cart.tax.title+': </td> <td class="uk-text-right">'+parseFloat(cart.tax.value).toFixed(2)+' лв</td> </tr>'
                        : '')
                    +'  <tr class="cart-sum-row"><th colspan="5" class="uk-text-right "><span data-lang>Всичко</span>:</th><th class="uk-text-right uk-text-nowrap cart-sum"> '+cart.total.toFixed(2)+' лв</th></tr>'
                    +'</tfoot>');
                    $.each(cart.data, function(k,v){
                        $("table.shopping-cart-detailed").find("tbody").append('<tr>'
                        +'  <td class="uk-text-center uk-text-middle" style="width:1em"><a href="<?=URL_BASE?>products/view/index.php/'+v.url_rewrite+'/"><img src="<?=URL_BASE?>image.php/'+v.id_image+'/small/'+v.date_add+'" style="min-width:80px"></a></td>'
                        +'  <td class="uk-text-middle" data-id="'+v.id+'">'+v.title+'</td>'
                        +'  <td class="uk-text-right uk-text-middle">'+parseFloat(v.price).toFixed(2)+'</td>'
                        +'  <td class="uk-text-center uk-text-middle">'+v.unit+'</td>'
                        +'  <td class="uk-text-right uk-text-middle uk-form"><input type="number" class="quantity" style="width:5em" value="'+v.qty+'"></td>'
                        +'  <td class="uk-text-right uk-text-middle uk-text-nowrap">'+(v.price*v.qty).toFixed(2)+' лв</td>'
                        +'</tr>');
                    });
                }else{
                     $("table.shopping-cart-detailed").html("<tr><th class='uk-panel-box' data-lang>Кошницата е празна</th></tr>");
                     $(".checkout").hide();
                }
            });
            
            $("table.shopping-cart-detailed").on("change",".quantity",function(e){
                var id = $(this).closest("tr").find("[data-id]").data("id");
                var qty = $(this).val();
                
                $.post("<?=URL_BASE?>ajax.php?f=cart/postAdd",{"id_product":id,"qty":qty}).done(function(cart){
                    $(document).trigger("shopping-cart-changed",$.parseJSON(cart));
                });
            });
            
            $.getJSON("<?=URL_BASE?>ajax.php?f=cart/getCart",function(cart){ $(document).trigger("shopping-cart-changed",cart);});
        </script>