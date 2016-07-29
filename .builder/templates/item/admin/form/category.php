 <div class="uk-form-row">
                                <label class="uk-form-label"><span data-lang>__category.title__</span> <span class="uk-text-danger">*</span></label>
                                <div class="uk-form-controls"><select class="uk-width-1-1" data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/getCategories&getforselect" name="id_category"></select></div>
                                <script>$(document).on("categories-changed", function(e,d){
                                    var select = $("#modal-new-item [name=id_category]").html('<option value="0">-</option>');
                                    $.each(d.data, function(r,k){select.append('<option value="'+k.id+'" data-lang>'+k.name+'</option>');});
                                });</script>
                            </div>