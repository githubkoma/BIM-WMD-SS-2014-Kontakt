$.widget("kontakt.createDialog", $.ui.dialog, // Standard Template für Dialog
{  
  options: 
  {
  autoOpen: false, // fenster nicht öffnen bei instanziierung
  modal: true, // modal = behält Fokus auf dem Widget, bis "ok" gedrückt wird
  width: 550,
  show: 'clip'
  },
  
  // Methode "Open" ist für den Typ "Dialog" schon vordefiniert->überschreiben
  open: function()
  {
	//this._kontakt = kontakt; // Klassen-Attribut als temporäre Variable nutzen
	
	this.element.find(".validation_message").empty();
	
	this.element.find("#crt_nname_field").removeClass("ui-state-error");
	this.element.find("#crt_vname_field").removeClass("ui-state-error");
	this.element.find("#crt_company_field").removeClass("ui-state-error");
	
	//Felder rücksetzen!
	this.element.find("#crt_nname_field").val("");
	this.element.find("#crt_vname_field").val("");
	this.element.find("#crt_company_field").val("");
	this.element.find("#crt_phone_field").val("");
	this.element.find("#crt_city_field").val("");
	this.element.find("#crt_mail_field").val("");
	this.element.find("#crt_birthday_field").val("");

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
			that._insertKontakt();
			//that.close();
		}
	}];
	  // Überschriebene Methode mit gleichem Namen ausführen
	  this._super();
  },
  
  _insertKontakt: function()
  {

	var kontakt = {	// <- dies ist eine Javascript Klasse
		cNName: this.element.find("#crt_nname_field").val(),
		cVName: this.element.find("#crt_vname_field").val(),
		cCompany: this.element.find("#crt_company_field").val(),
		cPhone: this.element.find("#crt_phone_field").val(),
		cCity: this.element.find("#crt_city_field").val(),
		cMail: this.element.find("#crt_mail_field").val(),
		cBirthday: this.element.find("#crt_birthday_field").val()
	};
	
	$.ajax
	({
		type: "POST",
		url: "/BIM-WMD-SS-2014-Kontakt/Service/Kontakte",
		//headers: {"If-Match": this._kontakt.cVersion},
		data: kontakt,
		success: function()
		{
			//alert(kontakt);
			this._trigger("onKontaktCreated");
			this.close();
		},
		error: function(request)
		{
			this.element.find(".validation_message").empty();
			this.element.find("#crt_nname_field").removeClass("ui-state-error");
			this.element.find("#crt_vname_field").removeClass("ui-state-error");
			this.element.find("#crt_company_field").removeClass("ui-state-error");
			if (request.status==400) 
			{
				var validationMessages = $.parseJSON(request.responseText);
				if (validationMessages.nname)
				{
					alert(validationMessages);
					this.element.find(".validation_message").text(validationMessages.nname);
					this.element.find("#crt_nname_field").addClass("ui-state-error").focus();
				}
				
				if (validationMessages.vname)
				{
					alert(validationMessages);
					this.element.find(".validation_message").text(validationMessages.vname);
					this.element.find("#crt_vname_field").addClass("ui-state-error").focus();
				}
				
				if (validationMessages.company)
				{
					alert(validationMessages);
					this.element.find(".validation_message").text(validationMessages.company);
					this.element.find("#crt_company_field").addClass("ui-state-error").focus();
				}
				
			}
		},
		context: this
	});
  }
});