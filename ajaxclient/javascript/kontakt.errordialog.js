$.widget("todo.errorDialog", $.ui.dialog,
{  
  options: 
  {
  autoOpen: false,
  modal: true // modal = beh�lt Fokus auf dem Widget, bis "ok" gedr�ckt wird
  },
  
  // Methode "open" gibt es in Ursprungsklasse "dialog" schon, daher wird diese 
  // hier weiter �berschrieben mit zus�tzlichen Befehlen
  open: function(message)
  {
	// �berschriebene Methode mit gleichem Namen ausf�hren
	this.element.find(".message").text(message);
	this._super();
	
  },
  
  _create: function() 
  {
	// "this" bezieht sich innerhalb des Click-Handlers NICHT MEHR auf das 
	// Widget an sich, daher f�r den Zugriff in "that" zwischenspeichern
	var that = this;
	this.options.buttons = 
	[
	{		
		text: "Schlie�en",
		click: function()
	    {
		   that.close();
	    }
		
	}
	];
	  // �berschriebene Methode mit gleichem Namen ausf�hren
	  this._super();
  }

    
  
});