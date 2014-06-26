$.widget("kontakt.kontaktDetails", 
{  
	load: function(kontaktUri)
	{
		$.ajax(
		{
		url: kontaktUri,
		dataType: "json",
		success: function(kontakt) {
			//alert(todoUri);
			
			this.element.find(".nname").text(kontakt.cNName);
			this.element.find(".vname").text(kontakt.cVName);
			this.element.find(".company").text(kontakt.cCompany);
			this.element.find(".phone").text(kontakt.cPhone);
			this.element.find(".mail").text(kontakt.cMail);
			this.element.find(".age").text(kontakt.cAge);
			
			},
		// Über THIS soll hier das Widget referenziert werden
		context: this
		});
	}
});