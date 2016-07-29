  <?php /*** Modal image */?>
            <?php $s = parse_ini_file(INI_DIR.'__MODULE__/images.ini',true); $s=$s['categories'];?>
            
            <div id="modal-image-category" class="uk-modal" >
                <div class="uk-modal-dialog uk-modal-dialog-large"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Image of category</span> #<span name="id"></span></h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/postImage" data-trigger="category-changed,category-changed-image">
                        <div class="uk-grid">
                            <div class="uk-width-small-2-3">
                                <div> <span data-lang>Full size</span>  <b name="size"></b> (<?=$s['image']['width'].' x '.$s['image']['height'];?>):</div>
                                <img id="categry-delimg-image"class="uk-thumbnail" src="image.php/1/image/">
                            </div>
                            <div class="uk-width-small-1-3">
                                <div><span data-lang>Thumbnail</span> (<?=$s['thumb']['width'].' x '.$s['thumb']['height'];?>):</div>
                                <img id="categry-delimg-thumb" class="uk-thumbnail" src="image.php/1/thumb/">
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="file" id="select-category-image" name="images[]" class="uk-hidden" onchange="if($(this).val()) $(this).closest('form').submit()">
                        <br>
                        <div class="uk-text-right">
                            <span class="upload-progress" data-lang>Upload:</span>
                            <a href="#modal-tune-upload-image" data-uk-modal='{modal:false}' onclick="$('#modal-tune-upload-image [name=id]').val($('#form-product-upload-image [name=id]').val());" class="uk-button uk-button-primary" ><i class="uk-icon-object-group"></i> <span data-lang>Tune upload</span></a>
                            <button type="button" class="uk-button uk-button-success" onclick="$('#select-category-image').click()" data-lang>Quick upload</span></button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $(document).on("category-changed-image",function(e,ret){
                    $("#categry-delimg-image").attr("src","image.php/"+ret.id+"/image/"+ret.date_image);
            		$("#categry-delimg-thumb").attr("src","image.php/"+ret.id+"/thumb/"+ret.date_image); 
                });
            </script>

            
            <?php /*** Modal Tune Upload IMAGE */ ?>
             <div id="modal-tune-upload-image" class="uk-modal no-ajax" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Tune Upload image</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/postImage" data-trigger="category-changed,category-changed-image" method="post">
                        <input type="hidden" name="id_parent">
                        <input type="hidden" name="picEdit" value="1">
                        
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
                        
                        $(document).trigger("category-changed",result);
                        $(document).trigger("category-changed-image",result);
                        
                        UIkit.modal( $("#modal-tune-upload-image") ).hide();
                    }                 
                });
            </script>