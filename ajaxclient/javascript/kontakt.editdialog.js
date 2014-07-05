$.widget("kontakt.editDialog", $.ui.dialog, // Standard Template für Dialog
{  
  options: 
  {
  autoOpen: false, // fenster nicht öffnen bei instanziierung
  modal: true, // modal = behält Fokus auf dem Widget, bis "ok" gedrückt wird
  width: 550,
  show: 'clip'
  },
  
  // Methode "Open" ist für den Typ "Dialog" schon vordefiniert->überschreiben
  open: function(kontakt)
  {
	this._kontakt = kontakt; // Klassen-Attribut als temporäre Variable nutzen
	
	this.element.find(".validation_message").empty();
	this.element.find("#nname_field").removeClass("ui-state-error");
	this.element.find("#vname_field").removeClass("ui-state-error");
	this.element.find("#company_field").removeClass("ui-state-error");
	
	this.element.find("#nname_field").val(kontakt.cNName); 
	this.element.find("#vname_field").val(kontakt.cVName); 
	this.element.find("#company_field").val(kontakt.cCompany);
	this.element.find("#phone_field").val(kontakt.cPhone); 
	this.element.find("#city_field").val(kontakt.cCity); 
	this.element.find("#mail_field").val(kontakt.cMail);
	var dateFormat = kontakt.cBirthDay;
	var dateFormat = $.datepicker.formatDate('dd.mm.yy', new Date(dateFormat));
	this.element.find("#birthday_field").val(dateFormat);
	
	this._super(); // "Open" der Basisklasse aufrufen, um Dialog zu öffnen
	
  },
    
  _create: function()
  {
	// "this" bezieht sich innerhalb des Click-Handlers NICHT MEHR auf das 
	// Widget an sich, daher für den Zugriff in "that" zwischenspeichern
	var that = this;
	this.options.buttons = [ // <- Dies ist ein Array
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
			that._updateKontakt();
			//that.close();
		}
	}];
	  // Überschriebene Methode mit gleichem Namen ausführen
	  this._super();
  },
  
  _updateKontakt: function()
  {

	var kontakt = {	// <- dies ist eine Javascript Klasse
		cNName: this.element.find("#nname_field").val(),
		cVName: this.element.find("#vname_field").val(),
		cCompany: this.element.find("#company_field").val(),
		cPhone: this.element.find("#phone_field").val(),
		cCity: this.element.find("#city_field").val(),
		cMail: this.element.find("#mail_field").val(),
		cBirthday: this.element.find("#birthday_field").val()
	};
	
	$.ajax
	({
		type: "PUT",
		url: this._kontakt.url,
		headers: {"If-Match": this._kontakt.cVersion},
		data: kontakt,
		success: function()
		{
			//alert(kontakt);
			this._trigger("onKontaktUpdated");
			this.close();
		},
		error: function(request)
		{
			this.element.find(".validation_message").empty();
			this.element.find("#nname_field").removeClass("ui-state-error");
			this.element.find("#vname_field").removeClass("ui-state-error");
			this.element.find("#company_field").removeClass("ui-state-error");
			if (request.status==400) 
			{
				var validationMessages = $.parseJSON(request.responseText);
				if (validationMessages.nname)
				{
					alert(validationMessages);
					this.element.find(".validation_message").text(validationMessages.nname);
					this.element.find("#nname_field").addClass("ui-state-error").focus();
				}
				
				if (validationMessages.vname)
				{
					alert(validationMessages);
					this.element.find(".validation_message").text(validationMessages.vname);
					this.element.find("#vname_field").addClass("ui-state-error").focus();
				}
				
				if (validationMessages.company)
				{
					alert(validationMessages);
					this.element.find(".validation_message").text(validationMessages.company);
					this.element.find("#company_field").addClass("ui-state-error").focus();
				}
				
			}
		},
		context: this
	});
  }
});