$.widget("kontakt.kontaktListe", 
{  
  // Javascript kennt kein private/public. Laut Programmierkonvention "soll" man
  // für private Eigenschaften mit einem _ Unterstrich beginnen
  _load: function(pageSize,recFrom,sortOrder)
	{	
		$.ajax(
		{
		   url: "/BIM-WMD-SS-2014-Kontakt/Service/Kontakte",
		   dataType: "json",
		   headers: {"RecordFrom": recFrom, "PageSize": pageSize, "OrderDir": sortOrder, "OderBy": "cNName"},
		   success: this._appendKontakte,
		   complete: this._BuildPageNum,
		   context: this,

		});		
	},
	
  	_create: function() 
    {	// _ bedeutet Privat, diese Methode ist wie ein Konstruktor
		var that=this;
		this._load(10,0,"ASC");
			
		this.element.find(".kontakt_sort_up").click(function()
			{
				that._trigger("onUpKontaktClicked");
				return false; 
			});
	
		this.element.find(".kontakt_sort_down").click(function()
			{
				that._trigger("onDownKontaktClicked");
				return false; 
			});	
		
		// this.element.find(".orderby_value").checked(function()
			// {
				// that._trigger("onOrderValueClicked");
				// return false; 
			// });		
	},
  	
	reload: function(pagenum,sortOrder)
	{
		this.element.find(".kontakt:not(.template)").remove();	
		
		if  (sortOrder != "")
		{
			this.element.find(".sortOrder").text(sortOrder);
		};
		sortOrder = this.element.find(".sortOrder").text();

		if  (pagenum > 0)
		{
			pageSize = 10;
			recFrom = pagenum * pageSize - pageSize;
		} else
			{
				recFrom = 0;
				pageSize = 10;
			};		
		
		var test = this.element.find("#orderby").val();
		alert(test);
		
		
		this._load(pageSize,recFrom,sortOrder);
	},
   
	_appendKontakte: function(kontakte) 
	{	
		var that = this;	
		//alert(kontakte.length);
		for (var i = 0; i < kontakte.length; i++) 
		{			
			//alert("Datensatz "+i);
			var kontakt = kontakte[i];
			// this.element = Zugriff auf beim Aufruf verknüpftes HTML Element "#todo_list")
			var kontaktElement = this.element.find(".template").clone();
			kontaktElement.removeClass("template"); // Klassenbezeichner aus HTML entfernen
			
			kontaktElement.find(".nname").text(kontakt.cNName);
			kontaktElement.find(".vname").text(kontakt.cVName);
			kontaktElement.find(".company").text(kontakt.cCompany);
			kontaktElement.find(".phone").text(kontakt.cPhone);
			
			// Asynchron: Wird erst ausgeführt, wenn geklickt wird.
			// Alles was bei click() als Parameter angegeben wird (todo.url),
			// wird über (event) schon zum Zeit der Code-Registrierung übergeben
			// und zwischengespeichert. Die Funktion wird erst später bei klick ausgeführt.
			// Sonst hätte todo.url immer den Wert des letzten Todos.....
			kontaktElement.click(kontakt.url, function(event)
			{
				that._trigger("onKontaktClicked", null, event.data); // "Geklickt" zurückgeben
			});
			
			kontaktElement.find(".delete_kontakt").click(kontakt, function(event)
			{
				//alert("delete und so");
				that._trigger("onDeleteKontaktClicked", null, event.data);
				// Event Bubble deaktivieren und Browser-Aktion (Link verfolgen) 
				// ausschalten. Nun kommen keine weiteren Eventhandler zum Zuge:
				return false; 
			});
			
			kontaktElement.find(".edit_kontakt").click(kontakt, function(event)
			{			
				//alert("Edit-Todo");
				that._trigger("onEditKontaktClicked", null, event.data); // "Geklickt" zurückgeben
				return false;
			});
			
			this.element.append(kontaktElement); // Element nun in HTML anhängen		
			
		}
	},
	
	_BuildPageNum: function(response)
	{
		var that = this;

		pages = response.getResponseHeader('PageSize');
		for (var i = 0; i < pages; i++) 
		{
			
			var pageElement = this.element.find(".pagesize").clone();
			pageElement.removeClass("pagesize");
			var pagenum = i + 1;
			pageElement.find(".page").text(pagenum);
			pageElement.click(pagenum, function(event)
			{
				that._trigger("onPageClicked", null, event.data); // "Geklickt" zurückgeben
			});
			this.element.append(pageElement);
		}
	}
  
});