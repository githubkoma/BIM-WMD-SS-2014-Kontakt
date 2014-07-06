$.widget("kontakt.kontaktDetails", 
{  	// Definiton des Widgets mit Name ""
    load: function(kontaktUri)
	{		
		$.ajax(
		{	   
		   url: kontaktUri,
		   dataType: "json",
		   success: this._appendKontakt,
		   context: this
		});
	},
	
	_appendKontakt: function(kontakt)
	{
		var that = this;
		//alert(kontakt);
		this.element.find(".nname").text(kontakt.cNName);
		this.element.find(".vname").text(kontakt.cVName);
		this.element.find(".company").text(kontakt.cCompany);
		this.element.find(".city").text(kontakt.cCity);
		var dateFormat = kontakt.cBirthDay;
		var dateFormat = $.datepicker.formatDate('dd.mm.yy', new Date(dateFormat));
		this.element.find(".birthday").text(dateFormat);
		this.element.find(".mail").text(kontakt.cMail);
		this.element.find(".phone").text(kontakt.cPhone);
		var dateFormat = kontakt.cCrtDate;
		var dateFormat = $.datepicker.formatDate('dd.mm.yy', new Date(dateFormat));
		this.element.find(".crtdate").text(dateFormat);
		this.element.find(".crtuser").text(kontakt.cCrtUser);
		var dateFormat = kontakt.cUpdtDate;
		var dateFormat = $.datepicker.formatDate('dd.mm.yy', new Date(dateFormat));
		this.element.find(".updtdate").text(dateFormat);	
		this.element.find(".updtuser").text(kontakt.cUpdtUser);
		//this.element.find(".age").text(kontakt.cAge);  ? wird doch berechnet ? sollte dies nciht im Client passieren ?
		/* this.element.click(kontakt.url, function(event)
			{
				that._trigger("onKontaktClicked", null, event.data);
			});
		*/
    }
});