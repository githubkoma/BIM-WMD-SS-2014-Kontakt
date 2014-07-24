Ext.define('Kontaktliste.view.KontaktList', 
{
	extend: 'Ext.dataview.List',
	xtype: 'kontaktlist',
	requires:
	[
		'Ext.plugin.PullRefresh',
		'Ext.plugin.ListPaging',
	],
	
	config: 
	{
		store: 'Kontakte',
		xtyp: 'kontaktlist',
		ui: 'round',
		pinHeaders: false,
		itemTpl: '<div>Name: {cNName}, {cVName}</div><div>Mail: {cMail}</div><div>Phone: {cPhone}</div>',
		grouped: true,
		emptyText: 'keine Kontakte',
		
		plugins: 
		[
			{
				type: 'pullrefresh',
				pullText: 'Zum Aktualisieren herunterziehen ...',
				releaseText: 'Zum Aktualisieren losslassen ...',
				loadingText: 'Laden ...',
				loadedText: '',
				lastUpdatedText: '',
				lastUpdatedDateFormat: ' ',
            },
			{
				type: 'listpaging',
				autoPaging: false,
				loadMoreText: 'Weitere Kontakte ...',
				noMoreRecordsText: 'Keine weiteren Kontakte!'
			},
		],
	},
});
