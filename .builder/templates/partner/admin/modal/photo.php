  <?php /*** Modal image */?>
            <?php $s = parse_ini_file(INI_DIR.'__MODULE__/images.ini',true); $s=$s['profile'];?>
            
            <div id="modal-image-partner" class="uk-modal" >
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3><span data-lang>Photo of partner</span> #<span name="id"></span></h3> </div>
                    <form action="<?=URL_BASE?>ajax.php?f=__MODULE__/postImage" data-trigger="partner-updated,partner-changed-image">
                        <div class="uk-grid">
                            <div class="uk-width-small-2-3">
                                <div> <span data-lang>Full size</span>  <b name="size"></b> (<?=$s['image']['width'].' x '.$s['image']['height'];?>):</div>
                                <img name="photo" class="uk-thumbnail" src="image.php/1/image/">
                                <img name="photo" class="uk-thumbnail uk-border-circle" src="image.php/1/image/">
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="file" id="select-partner-image" name="images[]" class="uk-hidden" onchange="if($(this).val()) $(this).closest('form').submit()">
                        <br>
                        <button type="submit" onclick="$('#select-partner-image').val('')" class="uk-button uk-float-left uk-text-danger"><i class="uk-icon-trash"></i> <span data-lang>Remove</span></button>
                        <div class="uk-text-right">
                            <span class="upload-progress" data-lang>Upload:</span>
                            <a href="#modal-tune-upload-image" data-uk-modal='{modal:false}' onclick="$('#modal-tune-upload-image [name=id]').val($('#form-product-upload-image [name=id]').val());" class="uk-button uk-button-primary" ><i class="uk-icon-object-group"></i> <span data-lang>Tune upload</span></a>
                            <button type="button" class="uk-button uk-button-success" onclick="$('#select-partner-image').click()" data-lang>Quick upload</span></button>
                            <button class="uk-modal-close uk-button" data-lang>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $(document).on("partner-changed-image",function(e,ret){
                    $("#modal-image-partner [name=photo]").attr("src","image.php/"+ret.id+"/"+ret.photo_date);
                });
            </script>

            
            <?php /*** Modal Tune Upload IMAGE */ ?>
             <div id="modal-tune-upload-image" class="uk-modal no-ajax" data-hide-on-submit>
                <div class="uk-modal-dialog"> <a class="uk-modal-close uk-close"></a>
                    <div class="uk-modal-header"> <h3 data-lang>Tune Upload image</h3> </div>
                    <form class="uk-form uk-form-horizontal" action="<?=URL_BASE?>ajax.php?f=__MODULE__/postImage" data-trigger="partner-changed,partner-changed-image" method="post">
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
                        $(document).trigger("partner-updated",result);
                        $(document).trigger("partner-changed-image",result);
                        UIkit.modal( $("#modal-tune-upload-image") ).hide();
                    }                 
                });
            </script>