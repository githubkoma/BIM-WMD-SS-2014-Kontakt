Ext.define('Kontaktliste.model.Kontakt', 
{
	extend: 'Ext.data.Model',
	config: 
	{
		fields: 
		[
			{
				name: 'cVName'
			},
			{
				name: 'cNName'
			},
			{
				name: 'cCompany'
			},
			{
				name: 'cCity'
			},
			{
				name: 'cBirthDay',
				type: 'date',
			},
			{
				name: 'cAlter'
			},
			{
				name: 'cMail',
			},
			{
				name: 'cPhone'
			},			
			{
				name: 'cCrtDate',
				type: 'date'
			},			
			{
				name: 'cCrtUser'
			},		
			{
				name: 'cUpdtDate',
				type: 'date'
			},		
			{
				name: 'cUpdtUser'
			},
			{
				name: 'cVersion'
			}
		],
		idProperty: 'url', //Entfernen doppelter Einträge nach Reload
	}
});
