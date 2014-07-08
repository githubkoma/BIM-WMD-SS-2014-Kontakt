$.widget("kontakt.navigation", 
{  
 
	_create: function() {
	
	var that=this;

	this.element.find(".prev_page").click(function()
			{
				//alert("delete und so");
				that._trigger("onPreviousPageClicked");
				// Event Bubble deaktivieren und Browser-Aktion (Link verfolgen) 
				// ausschalten. Nun kommen keine weiteren Eventhandler zum Zuge:
				return false; 
			});
	
	this.element.find(".next_page").click(function()
			{
				//alert("delete und so");
				that._trigger("onNextPageClicked");
				// Event Bubble deaktivieren und Browser-Aktion (Link verfolgen) 
				// ausschalten. Nun kommen keine weiteren Eventhandler zum Zuge:
				return false; 
			});
	
	this.element.find("#elements").click(function()
			{
				//alert("delete und so");
				that._trigger("onElemPageClick");
				// Event Bubble deaktivieren und Browser-Aktion (Link verfolgen) 
				// ausschalten. Nun kommen keine weiteren Eventhandler zum Zuge:
				return false; 
			});
	}
 
});