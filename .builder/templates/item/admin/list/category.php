{ data:"category", title:(lang["__category.title__"]||"__category.title__"),render:function(d,t,r){
            		    return r.cat_is_visible == 1 ? (d?d:"") : '<strike class="uk-text-muted">'+(d?d:"")+'</strike>';
            		}},