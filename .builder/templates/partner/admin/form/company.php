<div class="uk-form-row">
                        <label class="uk-form-label" data-lang>__company.title__</label>
                        <div class="uk-form-controls">
                            <select class="select2 uk-width-1-1" style="width:100%" 
                                data-allow-clear="true" 
                                data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/companies/getCompanies" 
                                multiple name="id_company[]"
                                data-templateResult="__FORM_COMPANY_LOGO_RESULT__ {{name}}" 
                                data-templateSelection="__FORM_COMPANY_LOGO_SELECT__ {{name}}" 
                            ></select>
                        </div>
                    </div>