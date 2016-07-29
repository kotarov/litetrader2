{ data:"is_active", title:(lang["__active.title__"]||"__active.title__"), width:"1em", class:"uk-text-center", render:function(d,t,r){
            		    return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/postToggleItem" class="uk-icon-eye'+(d?'':'-slash uk-text-muted')+'" data-toggle="is_active" data-trigger="item-updated" data-post=\'{"id":"'+r.id+'"}\'></a>';
            		}},