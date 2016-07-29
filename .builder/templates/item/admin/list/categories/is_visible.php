{ data:"is_visible", title:(lang["Vis"]||"Vis"), width:"1em", class:"uk-text-center", render:function(d,t,r){
            		    return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/categories/postToggleCategory" class="uk-icon-eye'+(d?'':'-slash uk-text-muted')+'" data-toggle="is_visible" data-trigger="category-changed" data-post=\'{"id":"'+r.id+'"}\'></a>';
            		}},