{ data:"is_advertise", title:"Ad", width:"1em", class:"uk-text-center", render: function(d,t,r){
            		    var icon = (d==1) ? "uk-icon-flag uk-text-danger" : "uk-icon-flag-o uk-text-muted";
            		    return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/postToggleItem" data-trigger="item-updated" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_advertise" class="'+icon+'"><i hidden>'+d+'</i></a>';
            		}},