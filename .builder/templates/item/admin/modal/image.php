<?php /*** Modal Image */?>
            <div id="modal-image-item" class="uk-modal">
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Images of product</span> #<span name="id" class="uk-text-muted"></span></h3> </div>
                    
                    <table id="list-item-images" cellspacing="0" width="100%" 
                        data-trigger-reload="item-image-changed" 
                        data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/images/getImages" 
                        class="dataTable uk-table uk-table-hover uk-table-striped uk-table-condensed" 
                    >
                    </table>
                    <script>$("#list-item-images").DataTable({
                        dom: 't',
                        paginate: false,
                        order: [[ "2", "asc" ]],
                        columns: [
                            { data: "is_cover", title:(lang["Cover"]||"Cover"), width:"1em", "class":"uk-text-center",orderable:false,render:function(d,t,r){
                                return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/images/postUpdateCover" data-toggle data-post=\'{"id":"'+r['id']+'"}\' data-trigger="item-image-changed,item-updated" class="'+(d?"uk-icon-star":"uk-icon-star-o")+'"></a>';
                            }},
                            { data:"id", title:"", orderable:false, sortable:false, render:function(d,t,r){
                                return '<a href="#dialog-preview-image" data-id="'+r['id']+'" data-uk-modal="{modal:false}" data-get="id='+r['id']+'" data-populate=\'{"id":"'+r['id']+'"}\'><img width="40" src="image.php/'+r['id']+'/small/'+r['date_add']+'"></a>';
                            }   },
                            { data:"name", title:(lang['Name']||"Name") },
                            { data: "size", title:(lang["Size"]||"Size"),"class":"uk-text-right" },
                            { data: "actions", title:"", searchable:false, orderable:false, class:"uk-text-center uk-text-middle uk-text-nowrap actions",
                                render:function(d,t,r,m){
                                    return '<a href="#modal-delete-image" onclick=\'$("#delete-image-preview").attr("src","image.php/'+r['id']+'/small/'+r['date_add']+'")\' class="uk-icon-times" data-uk-modal="{modal:false}" data-populate=\'{"id":"'+r['id']+'"}\' title="Remove"></a>';
                            }   }
                        ]
                    });</script>
                                    
                    <form id="form-product-upload-image" action="<?=URL_BASE?>ajax.php?f=__MODULE__/images/postImages" data-trigger="item-image-changed,item-updated">
                        <input type="hidden" name="id">
                        <input type="file" id="select-product-image-files" name="images[]" multiple class="uk-hidden" onchange="if($(this).val()) $(this).closest('form').submit()">
                        <div class="uk-text-right">
                            <span class="upload-progress" data-lang>Upload:</span>
                            <a href="#modal-tune-upload-image" data-uk-modal='{modal:false}' onclick="$('#modal-tune-upload-image [name=id]').val($('#form-product-upload-image [name=id]').val());" class="uk-button uk-button-primary" ><i class="uk-icon-object-group"></i> <span data-lang>Tune upload</span></a>
                            <button type="button" class="uk-button uk-button-success" onclick="$('#select-product-image-files').click()"><i class="uk-icon-cloud-upload"></i> <span data-lang>Quick upload</span></button>
                            <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php /*** Modal Tune Upload IMAGE */ ?>
             <div id="modal-tune-upload-image" class="uk-modal no-ajax" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Tune Upload image</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/images/postImages" data-trigger="item-image-changed,item-updated" method="post">
                        <input type="hidden" name="id_parent">
                        <input type="hidden" name="picEdit" value="1">
                        <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Name</label>
                                <div class="uk-form-controls"> 
                                    <input class="uk-width-1-1" type="text" name="name"> 
                                    <p class="uk-form-help-block" data-lang>Live blank to keep original image name</p>
                                </div>
                        </div>
                        <div class="uk-form-row">
                                <label class="uk-form-label" data-lang>Image</label>
                                <div class="uk-form-controls"> <input type="file" name="images[]" class="picEdit"> </div>
                        </div>
                        <br>

                        <div class="uk-form-controls"> 
                            <div class="uk-float-left">
                                <button type="button" class="uk-button uk-button-success" onclick='$("#modal-tune-upload-image").find(".ico-picedit-picture").click();' ><i class="uk-icon-file-image-o"></i> <span data-lang>Load</button>
                                <button type="button" class="uk-button uk-button-success" onclick='$("#modal-tune-upload-image").find(".ico-picedit-camera").click();' ><i class="uk-icon-camera"></i> <span data-lang>Photo</button>
                            </div>
                            <div class="uk-text-right">
                                <button type="submit" class="uk-button uk-button-primary" name="picEditButton"><i class="uk-icon-cloud-upload"></i> <span data-lang>Upload</span></button>
                                <button type="button" class="uk-modal-close uk-button" data-lang>Exit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $('#modal-tune-upload-image .picEdit').picEdit({
                    formSubmitted: function(res){
                        var result = $.parseJSON(res.response);
                        
                        $(document).trigger("item-image-changed",result);
                        $(document).trigger("item-updated",result);
                        
                        UIkit.modal( $("#modal-tune-upload-image") ).hide();
                    }                 
                });
            </script>
            <?php /*** Modal Delete IMAGE */ ?>
            <div id="modal-delete-image" class="uk-modal" data-hide-on-submit>
                <div class="uk-modal-dialog uk-modal-dialog-small"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Delete image</h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=__MODULE__/images/postDelete" data-trigger="item-image-changed,item-updated">
                        <p><span data-lang>Are you sure you want to delete this image from item</span> #<b name="id_parent"></b> ?</p>
                        <div><img id="delete-image-preview"></div>
                        <input type="hidden" name="id">
                        <div class="uk-text-right">
                            <button type="submit" class="uk-button uk-button-danger" data-lang>Delete</button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php /*** Modal Preview Image */ ?>
            <div id="dialog-preview-image" class="uk-modal">
                <div class="uk-modal-dialog uk-modal-dialog-blank"> <button class="uk-modal-close uk-close" type="button"></button>
                    <div class="uk-grid uk-flex-middle" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-2 uk-height-viewport uk-cover-background uk-row-first" style="background-image: url('image.php/0/full');"></div>
                        <div class="uk-width-medium-1-2">
                        <h1 data-lang>Image details</h1>
                            <div class="uk-width-medium-1-1">
                                <p><dl class="uk-description-list-horizontal image-details"></dl></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $("#modal-image-item").on("click","[href='#dialog-preview-image']",function(e){ e.preventDefault();
                    var id = $(this).data("id");
                    var dlg = "#dialog-preview-image";
                    $.getJSON("<?=URL_BASE?>ajax.php?f=__MODULE__/images/getInfo&id="+id).done(function(ret){
                        console.log(ret);
                        $(dlg).find(".uk-cover-background").css("background-image","url('image.php/"+id+"/full/"+ret.data[0]['date_add']+"')")
                        $(dlg).find(".image-details").html("").append(''
                            +'<dt data-lang>Image</dt><dd>'+ret.data[0]['name']+' (ID:'+ret.data[0]['id']+')</dd>'
                            +'<dt data-lang>Type</dt><dd>'+ret.data[0]['type']+'</dd>'
                            +'<dt data-lang>Size</dt><dd>'+ret.data[0]['size']+'</dd>'
                            +'<dt data-lang>Cover</dt><dd>'+(ret.data[0]['is_cover']?'Yes':'No')+'</dd>'
                            +'<dt data-lang>Product</dt><dd>'+ret.data[0]['item']+' (ID: '+ret.data[0]['id_product']+')</dd>'
                            +'<dt>&nbsp;</dt><dd>&nbsp;</dd>'
                            
                            +'<dt class="uk-text-muted">Small</dt><dd><b class="uk-text-muted">Thumb</b></dd>'
                            +'<dt><img src="image.php/'+ret.data[0]['id']+'/small/'+ret.data[0]['date_add']+'"> </dt>'
                            +'<dd><img src="image.php/'+ret.data[0]['id']+'/thumb/'+ret.data[0]['date_add']+'"> </dd>'
                        );
                    });
                });
            </script>
       