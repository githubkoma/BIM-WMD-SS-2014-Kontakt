Ext.define('Kontaktliste.store.Kontakte', 
{
	extend: 'Ext.data.Store',
	id: 'Kontakte',
	config: 
	{
		proxy:
		{
			type: 'rest',
			url: '/BIM-WMD-SS-2014-Kontakt/service/Kontakte',
			reader: 
			{
				type: 'json'
			},
			
			listeners: 
			{
				exception: function(proxy, request)
				{
					Ext.Msg.alert('Fehler', request.statusText);
				}	
			}
		},	
		
		model: 'Kontaktliste.model.Kontakt',		
		sorters: 'cNName',
		grouper: 
		{
			groupFn: function(record) 
			{
				return record.get('cNName')[0];
			}
		},
		autoLoad: true
	}
});
