{ data:"company",title: (lang['__company.title__']||'__company.title__'), render: function(d,t,r){
        if(d) return d.replace(/\,/g,", "); else return d;
            }},