$.widget("kontakt.menuBar", 
{  
 
	_create: function() {
	
	var that=this;
	
	this.element.find(".show_kontakte").click(function()
			{
				//alert("delete und so");
				that._trigger("onShowKontakteClicked");
				// Event Bubble deaktivieren und Browser-Aktion (Link verfolgen) 
				// ausschalten. Nun kommen keine weiteren Eventhandler zum Zuge:
				return false; 
			}),
			
	this.element.find(".create_kontakt").click(function()
			{
				//alert("delete und so");
				that._trigger("onCreateKontaktClicked");
				// Event Bubble deaktivieren und Browser-Aktion (Link verfolgen) 
				// ausschalten. Nun kommen keine weiteren Eventhandler zum Zuge:
				return false; 
			});
	
	}
 
});