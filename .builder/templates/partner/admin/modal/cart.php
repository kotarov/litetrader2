<?php /*** Modal cart */ ?>
        <div id="modal-cart-partner" class="uk-modal">
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Cart of partner</span> #<span name="id"></span></h3> </div>
                
                <table id="list-cart-partner" cellspacing="0" width="100%" 
                    data-trigger-reload="customercart-changed" 
                    data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/cart/getCart" 
                    class="dataTable uk-table uk-table-hover uk-table-striped uk-table-condensed" 
                >
                    <tfoot><td></td> <td></td> <td></td> <td></td> <td></td><td class="uk-text-right" data-lang>Sum:</td> <th class="sum"></th> <td></td></tfoot>                    
                </table>
                <script>$("#list-cart-partner").DataTable({
                    dom: 't',
                    paginate: false,
                    order: [[ "1", "asc" ]],
                    columns: [
                        { data:"image", title:"", orderable:false, sortable:false, render:function(d,t,r){
                            return '<img width="40" src="image.php/'+d+'/small/'+r['date_add']+'">';
                        }   },
                        { data:"product", title:(lang["Product"]||"Product"), render:function(d,t,r){return r['id_product']+'. '+d;}},
                        { data: "note", title:(lang['Note']||"Note") },
                        { data: "qty", title:(lang['Qty']||"Qty")},
                        { data: "mu", title: (lang['MU']||"MU") },
                        { data: "price", title:(lang['U.Price']||"U.Price")},
                        { data: "sum", title: (lang['Total']||"Total"), class:"sum", render:function(d,t,r,m){
                            return "<b>"+parseFloat(d).toFixed(2)+"</b>";
                        } },
                        { data: "actions", title:"", searchable:false, orderable:false, class:"uk-text-center uk-text-middle uk-text-nowrap",
                            render:function(d,t,r,m){
                                var del = '<a href="#modal-delete-from-cart" class="uk-icon-times" data-uk-modal="{modal:false}" data-populate=\'{"id":"'+r['id']+'","id_product":"'+r['id_product']+'","product":"'+r['product']+'"}\' title="Remove"></a>',
                                    edit= '<a href="#modal-edit-from-cart" class="uk-icon-edit" data-uk-modal="{modal:false}" data-get="id='+r['id']+'" data-populate=\'{"id":"'+r['id']+'"}\' title="Edit"></a>';
                                return edit + " " + del;
                        }   }
                    ],
                    drawCallback: function(){ 
                        var api = this.api(); $( api.table().footer() ).find(".sum").html(
                            parseFloat(api.column( ".sum", {page:'current'} ).data().sum()).toFixed(2)
                        );
                    }
                });</script>
                
                <div class="uk-text-right uk-margin-top">
                    <input type="hidden" name="id">
                    <button type="button" class="uk-button uk-button-primary" data-lang> Order</button>
                    <a href="#add-to-cart" type="button" class="uk-button uk-button-success" data-uk-modal="{modal:false}"><i class="uk-icon-cart-arrow-down"></i> <span data-lang>Add</span></a>
                    <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                </div>
            </div>
        </div>
        
        <?php /*** Modal Edit from cart */ ?>
        <div id="modal-edit-from-cart" class="uk-modal" data-get="ajax.php?f=customers/cart/getEditItem" data-hide-on-submit>
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Edit product of cart</span> #<span name="id_parent"></span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="ajax.php?f=customers/cart/postEditItem" data-trigger="customercart-changed,partner-updated">
                    <input type="hidden" name="id">
                    <div class="uk-form-row">
                        <label class="uk-form-label">Product <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" type="hidden" name="id_product"></select>
                            <input class="uk-width-1-1" name="product" readonly>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Note</label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" type="text" name="note">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Qty</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="qty"></div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>ME</label>
                        <div class="uk-form-controls">
                            <select class="uk-width-1-1" type="text" name="id_unit" 
                                data-value-depends-on="#add-to-cart [name=qty]" 
                                data-get="ajax.php?f=products/units/getMeasureUnits"
                            ></select>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Price</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" type="text" name="price"></div>
                    </div>
                    <div class="uk-text-right uk-margin-top">
                        <button type="submit" class="uk-button uk-button-primary" data-lang> Save</button>
                        <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php /*** Modal add to cart */ ?>
        <div id="add-to-cart" class="uk-modal" data-get="ajax.php?f=customers/cart/getNewCart" data-hide-on-submit>
            <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Add product to Cart</span></h3> </div>
                <form class="uk-form uk-form-horizontal" action="ajax.php?f=customers/cart/postAppendCart" data-trigger="customercart-changed,partner-updated">
                    <input type="hidden" name="id_parent">
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Product</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls">
                            <select id="addtocart-idproduct" class="uk-width-1-1 select2" style="width:100%"
                                name="id_product" 
                                data-placeholder="Search product"
                                data-ajax--url="ajax.php?f=products/searchProducts"
                                data-templateResult='
                                    <img class="uk-align-left" src="image.php/{{id}}/small" width="40"> 
                                    <span>{{id}}</span> {{text}} <small class="uk-text-muted">ref: {{reference}}</small>
                                    <div><sup><i class="uk-text-muted">{{category}}</i></sup></div>'
                                data-templateSelection='
                                    <img src="image.php/{{id}}/small" width="20"> 
                                    <span>{{id}}</span> {{text}}
                                    <small class="uk-text-muted">ref.{{reference}}</small>'
                            ></select>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>Note</label>
                        <div class="uk-form-controls">
                            <input class="uk-width-1-1" type="text" name="note">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Qty</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" data-depends-on="#addtocart-idproduct" data-get="ajax.php?f=products/getProduct" type="text" name="qty"></div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" data-lang>ME</label>
                        <div class="uk-form-controls">
                            <select class="uk-width-1-1" type="text" name="id_unit" 
                                data-value-depends-on="#add-to-cart [name=qty]" 
                                data-get="ajax.php?f=products/units/getMeasureUnits"
                            ></select>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label"><span data-lang>Price</span> <span class="uk-text-danger">*</span></label>
                        <div class="uk-form-controls"><input class="uk-width-1-1" data-depends-on="#add-to-cart [name=qty]" type="text" name="price"></div>
                    </div>
                    <div class="uk-text-right uk-margin-top">
                        <button type="submit" class="uk-button uk-button-primary" data-lang> Append</button>
                        <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php /*** Modal delete from cart */?>
         <div id="modal-delete-from-cart" class="uk-modal" data-hide-on-submit>
            <div class="uk-modal-dialog uk-modal-dialog-small"> <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header"> <h3><span data-lang>Delete product</span></h3> </div>
                <form action="ajax.php?f=customers/cart/postRemoveItem" method="post" data-trigger="customercart-changed,partner-updated">
                    <p><span data-lang>Remove this product</span> <br>"<b name="id_product"></b>. <b name="product"></b>" ?</p>
                    <input type="hidden" name="id">
                    <div class="uk-text-right">
                        <button type="submit" class="uk-button uk-button-danger" data-lang>Remove</button>
                        <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                    </div>
                </form>
            </div>
        </div>