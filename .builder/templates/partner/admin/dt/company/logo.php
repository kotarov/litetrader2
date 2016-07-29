{data:"logo", sortable:false, title:(lang["Logo"]||"Logo"), render:function(d,t,r){
                return '<a href="#modal-company-logo" data-populate=\'{"id":"'+r.id+'","logo":"image.php/'+r.id+'/'+r.logo_date+'"}\' data-uk-modal >'
                    +'<img style="max-width:40px;max-height:30px" src="image.php/'+r.id+'/'+r.logo_date+'" ></a>';
            }
        },