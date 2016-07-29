{ data:"is_visible", title:"Vis", searchable:false, width:"2em",
                    	render: function(d,t,r){
                    		var icon = (d == 1) ? "uk-icon-eye uk-text-success" : "uk-icon-eye-slash uk-text-muted";
                    		return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/postToggleItem" data-trigger="item-updated" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_visible" class="'+icon+'"><i hidden>'+d+'</i></a>';
                    	}
                    },