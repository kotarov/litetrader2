{ data:"company", title:(lang["Company"]||"Company"),render:function(d,t,r){
    var un = r.id_company > 0 ? '' : ' <small class="uk-badge uk-badge-warning">Unregistered</small> ';
    return (d?d+un:'<i class="uk-icon-home"></i> Home');
}},