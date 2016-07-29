{ data:"is_avaible", title:"Av", width:"2em",
            		    render: function(d,t,r){
            				var icon = (d == 1) ? "uk-icon-cart-arrow-down" : "uk-icon-ban uk-text-muted";
            				return '<a href="<?=URL_BASE?>ajax.php?f=__MODULE__/postToggleItem" data-trigger="item-updated" data-post=\'{"id":"'+r.id+'"}\' data-toggle="is_avaible" class="'+icon+'"><i hidden>'+d+'</i></a>';
            			}
                    },