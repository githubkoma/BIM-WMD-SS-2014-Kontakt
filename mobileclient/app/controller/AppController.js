Ext.define('Kontaktliste.controller.AppController',
{
	extend: 'Ext.app.Controller',
	config: 
	{
		control: 
		{
				kontaktlist:
					{
						itemtap: 'showKontaktDetails',
					},		
					'#refreshListButton':
					{
						tap: 'refreshKontaktList'
					},
				
					'#refreshDetailButton':
					{
						tap: 'refreshKontakt'
					},		
					'#homeButton':
					{
						tap: 'goHomeButton'
					},
					'#deleteButton':
					{
						tap: 'showConfirmDeleteDialog'
					},
				main: 
					{
						push: 'showFormButtons',
						pop:  'hideFormButtons'
					},	
		},

		refs: 
		{
			main: 'main',
			KontaktForm: 'kontaktform',
			deleteButton: '#deleteButton',
			homeButton: '#homeButton',
			refreshDetailButton: '#refreshDetailButton',
			refreshListButton: '#refreshListButton',
			detailButtons: '#detailButtons',
		}
	},
	
	showFormButtons: function()
	{
		Ext.getCmp('detailButtons').setHidden(false);
		Ext.getCmp('listButtons').setHidden(true);
	},

	hideFormButtons: function()
	{
		Ext.getCmp('detailButtons').setHidden(true);
		Ext.getCmp('listButtons').setHidden(false);
	},
	
	showKontaktDetails: function(list, index, target, record)
	{
		var main = this.getMain();
		var kontaktForm = Ext.widget('kontaktform');
		
		var wAge = this.computeAge(record.data.cBirthDay);
		record.data.cAlter = wAge;
		
		kontaktForm.setRecord(record);
		main.push(kontaktForm);	
	},
	
	showConfirmDeleteDialog: function()
	{
		Ext.Msg.confirm('Löschen', 'Wirklich löschen?', this.deleteKontakt, this);
	},
	
	refreshKontaktList: function()
	{
		var kontakte = Ext.getStore('Kontakte');
		kontakte.sync(
		{
			callback: function()
			{
				this.getMain().pop();
			},
			scope: this
		});
	},
	
	goHomeButton: function()
	{
		var kontakte = Ext.getStore('Kontakte');
		kontakte.sync();
		this.getMain().pop();
		scope: this;
	},
	
	refreshKontakt: function()
	{
		Ext.Msg.alert("refreshKontakt");
		var kontakt = this.getKontaktForm().getRecord();
		var kontakte = Ext.getStore('Kontakte');
		
		kontakte.sync(
		{
			callback: function()
			{
				this.getKontaktForm().pop();
			},
			scope: this
		});
	},
	
	deleteKontakt: function(buttonId)
	{
		if (buttonId != 'yes')
		{
			return;
		}
		var kontakt = this.getKontaktForm().getRecord();
		var kontakte = Ext.getStore('Kontakte');
		kontakte.remove(kontakt);
		kontakte.sync(
		{
			callback: function()
			{
				this.getMain().pop();
			},
			scope: this
		});
	},
	
	computeAge: function(bDate)
	{	
		var wAlter = "";
					
		if  (bDate != "") 
		{
			today = new Date();
			
			tag 	= today.getDate()  	  - bDate.getDate();
			monat 	= today.getMonth() 	  - bDate.getMonth();
			jahr 	= today.getFullYear() - bDate.getFullYear();
			
			if (tag < 0)
			{
				tag = 30 + tag;
				monat--;
			};
			
			if (monat < 0)
			{
				monat = 12 + monat;
				jahr--;
			};
			
			wAlter    = jahr + ' Jahre ' +
						'- ' + monat + ' Monat(e) ' +
						'- ' + tag + ' Tag(e)';
		};
		return wAlter;
	}
});