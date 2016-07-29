if(!window['index_owner_company']) $.each(settings.oInit.columns,function(k,v){ if(v.data == 'owner_company') window['index_owner_company'] = k;})
        		if($("#filterOwnerCompany option:selected").text() !== data[window['index_owner_company']] && $("#filterOwnerCompany").val() !== '0') ret = false;
