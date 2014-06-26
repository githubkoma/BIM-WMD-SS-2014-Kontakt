$.widget("kontakt.kontaktListe", 
{  
  // Javascript kennt kein private/public. Laut Programmierkonvention "soll" man
  // f�r private Eigenschaften mit einem _ Unterstrich beginnen
  _create: function() 
  {
	
	alert("Im Konstruktor kontaktListe");
	
	// Statische Hilfsmethode: jQuery.ajax({});
	$.ajax(
	{
		// Bei HTTP Anfragen wird nachfolgender Code asynchron ausgef�hrt
		url: "/GitHub/BIM-WMD-SS-2014-Kontakt/Service/Kontakte",
		dataType: "json",
		success: this._appendKontakte,
		context: this
		
	});
	
  },
  
  reload: function()
  {
    this.element.find(".kontakt:not(.template)").remove();
	$.ajax
	({
		url: "/GitHub/BIM-WMD-SS-2014-Kontakt/Service/Kontakte",
		dataType: "json",
		success: this._appendKontakte,
		context: this
	});
  },
	
	_appendKontakte: function(kontakte) 
	{	
		var that = this;
		
		alert("Kontakte eingelesen");
		for (var i = 0; i < kontakte.length; i++) 
		{			
			//alert("Datensatz "+i);
			var kontakt = kontakte[i];
			// this.element = Zugriff auf beim Aufruf verkn�pftes HTML Element "#todo_list")
			var kontaktElement = this.element.find(".template").clone();
			kontaktElement.removeClass("template"); // Klassenbezeichner aus HTML entfernen
			
			kontaktElement.find(".nname").text(kontakt.cNName);
			kontaktElement.find(".company").text(kontakt.cCompany);
			kontaktElement.find(".phone").text(kontakt.cPhone);
			
			// Asynchron: Wird erst ausgef�hrt, wenn geklickt wird.
			// Alles was bei click() als Parameter angegeben wird (todo.url),
			// wird �ber (event) schon zum Zeit der Code-Registrierung �bergeben
			// und zwischengespeichert. Die Funktion wird erst sp�ter bei klick ausgef�hrt.
			// Sonst h�tte todo.url immer den Wert des letzten Todos.....
			kontaktElement.click(kontakt.url, function(event)
			{				
				that._trigger("onKontaktClicked", null, event.data); // "Geklickt" zur�ckgeben
			});
			
			kontaktElement.find(".delete_kontakt").click(kontakt, function(event)
			{
				//alert("delete und so");
				that._trigger("onDeleteKontaktClicked", null, event.data);
				// Event Bubble deaktivieren und Browser-Aktion (Link verfolgen) 
				// ausschalten. Nun kommen keine weiteren Eventhandler zum Zuge:
				return false; 
			});
			
			this.element.append(kontaktElement); // Element nun in HTML anh�ngen		
			
			
			
		}
	}
  
});