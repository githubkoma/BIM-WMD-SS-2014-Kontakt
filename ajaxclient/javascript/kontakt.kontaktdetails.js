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
		
		wAge = this.computeAge(kontakt.cBirthDay);
		this.element.find(".age").text(wAge);
    },
	
	computeAge: function(bDate)
	{	
		var wAge = "";
		
		var wBDate = new Date(bDate);
		wBYear  = wBDate.getFullYear();
		wBMonth = wBDate.getMonth() + 1; //Warum auch immer ??? sonst fehlt ein Monat!
		wBDay   = wBDate.getDate();
		
		if  (((wBDay > 0) && (wBDay < 32)) && ((wBMonth > 0) && (wBMonth < 13)) && (wBYear > 1900))
		{
			today = new Date();	
			
			wdiffday 	= today.getDate()  	- wBDay;
			wdiffmonth 	= (today.getMonth() + 1)  - wBMonth;
			wdiffyear 	= today.getFullYear() - wBYear;
			
			if (wdiffday < 0)
			{
				wdiffday = 30 + wdiffday;
				wdiffmonth--;
			};
			
			if (wdiffmonth < 0)
			{
				wdiffmonth = 12 + wdiffmonth;
				wdiffyear--;
			};
			if  (wdiffyear < 0)
			{
				wdiffyear = 0;
			};
			
			wAge   = wdiffyear + ' Jahre ' +
						'- ' + wdiffmonth + ' Monat(e) ' +
						'- ' + wdiffday + ' Tag(e)';
		
		};
		return wAge;
	},
});