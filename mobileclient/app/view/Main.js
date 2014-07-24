Ext.define('Kontaktliste.view.Main', 
{
	extend: 'Ext.navigation.View',
	xtype: 'main',
	config: 
	{
		items:
		[	
			{
				xtype: 'kontaktlist'
			}
		],
		defaultBackButtonText: '',
		navigationBar:
		{		
			ui: 'neutral',
			docked: 'bottom',
			defaults:
			{
				iconMask: true,
				ui: 'plain',
			},

			backButton: 
			{ 
                iconCls:'arrow_left', 
                iconMask: true,
                ui: 'plain',
                cls: 'backButton',
            },
			
			items:
			[
				{
					xtype: 'segmentedbutton',
					id: 'listButtons',
					defaults:
					{
						iconMask: true,
						ui: 'plain',
					},
					items:
					[		
						{
							iconCls: 'add',
							id: 'addButton',
							handler: function()
							{
								Ext.Msg.alert("Kontakt hinzufügen!");
							}
						},			
						{
							iconCls: 'star',
							id: 'favoritesButton',
							handler: function()
							{
								Ext.Msg.alert("Favoriten anzeigen!");
							}
						},
						{
							iconCls: 'maps',
							id: 'mapsButton',
							handler: function()
							{
								Ext.Msg.alert("Kontakte in der Nähe!");
							}
						},
						{
							iconCls: 'refresh',
							id: 'refreshListButton',
							handler: function()
							{
								Ext.Msg.alert("Kontaktliste aktualisieren!");
							}
						},
						{
							iconCls: 'settings',
							id: 'settingsButton',
							handler: function()
							{
								Ext.Msg.alert("Einstellungen!");
							}
						},
						{
							iconCls: 'trash',
							id: 'trashButton',
							handler: function()
							{
								Ext.Msg.alert("Gelöschte Kontakte!");
							}
						},
						{
							iconCls: 'search',
							id: 'searchButton',
							handler: function()
							{
								Ext.Msg.prompt("Kontakt suchen ...");
							}
						},
					]
				},
				
				{
					//Buttons für das Detailfenster
					xtype: 'segmentedbutton',
					id: 'detailButtons',
					hidden: true,
					defaults:
					{
						iconMask: true,
						ui: 'plain',
					},
					items:
					[			
						{ 
							iconCls: 'home',
							id: 'homeButton',
						},		
						{
							iconCls: 'compose',
							id: 'editButton',
							handler: function()
							{
								Ext.Msg.alert("Kontakt editieren");
							}
						},
						{
							iconCls: 'delete',
							id: 'deleteButton',
							handler: function()
							{
								Ext.Msg.alert("Kontakt löschen!");
							}
						},		
						{
							iconCls: 'star',
							id: 'changeFavoritButton',
							handler: function()
							{
								Ext.Msg.alert("Als Favorit markieren!");
							}
						},
						{
							iconCls: 'maps',
							id: 'locateButton',
							handler: function()
							{
								Ext.Msg.alert("Standort anzeigen!");
							}
						},
						{
							iconCls: 'refresh',
							id: 'refreshDetailButton',
							handler: function()
							{
								Ext.Msg.alert("Kontakt aktualisieren!");		
							},
						},
					]
				}
			]
		}
	}
});

