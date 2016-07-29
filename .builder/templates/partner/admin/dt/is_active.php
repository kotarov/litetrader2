{ data:"is_active", title: (lang['__active.title__']||'__active.title__'), width:"1em", class:"uk-text-center", render:function(d,t,r){
        			var icon = d ? "uk-icon-user" : "uk-icon-user-times uk-text-muted";
        			return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/postToggle" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_active" data-trigger="partner-updated" class="'+icon+'"></a><span class="uk-hidden">'+d+"</span>";
        		}},