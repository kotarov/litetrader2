{	text:'<select id="filterOwnerCompany" data-get="<?=URL_BASE?>ajax.php?f=__MODULE__/owners/getOwners&company&withdash" onChange="$(\'#items\').DataTable().draw()"></select>',
            			className:"uk-float-left uk-margin-right "
            		},