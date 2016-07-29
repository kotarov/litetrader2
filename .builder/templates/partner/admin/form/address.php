<?php if(!isset($cities_opts)){
    $cities_opts = '';
    foreach(parse_ini_file(INI_DIR.'cities-bg.ini',true) AS $region=>$cc){
        $cities_opts .= '<optgroup label="'.$region.'">';
        foreach($cc AS $city=>$r) $cities_opts .= '<option value="'.$city.'"data-region="'.$region.'">'.$city.'</option>';
        $cities_opts .= '</optgroup>';
    } 
}?>
<div class="uk-form-row">
                        <label class="uk-form-label" data-lang>__address.title__</label>
                        <div class="uk-form-controls uk-grid">
                            <input class="uk-width-small-1-2" type="text" placeholder="__country.title__" title="__country.title__" name="country" value="България">
                            <span class="uk-width-small-1-2" style="padding:0">
                                <select name="city" style="width:100%" class="select2" data-lang
                                    title="City"
                                ><?=$cities_opts?></select>
                            </span>
                            
                            <?php /*<input class="uk-width-small-1-2" type="text" placeholder="__city.title__" title="__city.title__" name="city"> */?>
                            <input class="uk-width-small-1-1" type="text" placeholder="__street.title__" title="__street.title__" name="address">
                        </div>
                    </div>