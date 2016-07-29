<div class="uk-form-row">
                                <label class="uk-form-label" data-lang>__owner.person.title__</label>
                                <div class="uk-form-controls uk-grid uk-grid-collapse">
                                    
                                    <div class="uk-width-1-1"><select class="uk-width-1-1 select2" style="width:100%"
                                        name="id_owner"
                                        data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/owners/getOwners&person" 
                                        data-templateSelection='{{text}}'
                                        data-templateResult='{{text}}'
                                    ></select></div>
                                </div>
                            </div>