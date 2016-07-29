{ data:"photo", sortable:false, title: (lang['__photo.title__']  ||'__photo.title__'), render:function(d,t,r){
    return '<a href="#modal-image-partner" '
        +' data-uk-modal data-populate=\'{"id":"'+r.id+'","photo":"image.php/'+r.id+'/'+r.photo_date+'"}\'>'
    +'<img style="width:30px" class="uk-border-circle" src="image.php/'+r.id+'/'+r.photo_date+'"></a>';
} },