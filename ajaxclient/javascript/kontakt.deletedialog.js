$.widget("kontakt.deleteDialog", $.ui.dialog,
{  
  options: 
  {
  autoOpen: false, // fenster nicht �ffnen bei instanziierung
  modal: true // modal = beh�lt Fokus auf dem Widget, bis "ok" gedr�ckt wird
  },
  
  open: function(kontakt)
  {
	this._kontakt = kontakt; // Klassen-Attribut als tempor�re Variable nutzen
	this._super();
  },
  
  _create: function() 
  {
	// "this" bezieht sich innerhalb des Click-Handlers NICHT MEHR auf das 
	// Widget an sich, daher f�r den Zugriff in "that" zwischenspeichern
	var that = this;
	this.options.buttons = [ // <- Dies ist ein Array aus Buttons
	{		
		text: "Abbrechen",
		click: function()
		{
		that.close();
		}
		
	},
	 
	{		
		text: "Ok",
		click: function()
		{
			that._deleteKontakt();
			that.close();
		}
	}];
	  // �berschriebene Methode mit gleichem Namen ausf�hren
	  this._super();
  },

  _deleteKontakt: function()
  {
	$.ajax(
	{
		type: "DELETE",
		url: this._kontakt.url,
		success: function()
		{
			this._trigger("onKontaktDeleted");
		},
		context: this
	});
	alert("Kontakt gel�scht");
  }    
  
});