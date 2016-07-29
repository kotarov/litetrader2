{ data:"image", title:(lang["__image.title__"]||"__image.title__"), orderable:false, searchable:false,
            			render: function ( d, t, r ) { var badge = r.nb_images > 0 ? '<sup class="uk-badge">'+r.nb_images+'</sup>' : '';
            				return '<a href="#modal-image-item" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'"}\'>'
            						+'<img src="image.php/'+d+'/small/'+r.date_image+'" width="40" >'+badge+'</a>';
            		}},