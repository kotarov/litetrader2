{ data:"is_advertise", title: (lang['__advertise.title__']||'__advertise.title__'), width:"1em", class:"uk-text-center", render:function(d,t,r){
        			var icon = (d==1) ? "uk-icon-envelope uk-text-danger" : "uk-icon-envelope-o uk-text-muted";
        			return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/postToggle" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_advertise" data-trigger="partner-updated" class="'+icon+'"></a><span class="uk-hidden">'+d+"</span>";
        		}},