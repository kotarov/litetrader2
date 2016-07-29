{ data:"image", title:(lang["Image"]||"Image"), width:"1em", orderable:false, searchable:false,
            			render: function ( d, t, r ) {
            				return '<a href="#modal-image-category" data-uk-modal data-get="id='+r.id+'" data-populate=\'{"id":"'+r.id+'","size":"'+r.image_size+'"}\''
            				            +' onclick=\'$(document).trigger("category-changed-image",{\"id\":\"'+r.id+'\",\"date_image\":\"'+r.date_image+'\"})\'>'
            						+'<img src="image.php/'+d+'/thumb/'+r.date_image+'" width="40" ></a>';
            			}
            		},