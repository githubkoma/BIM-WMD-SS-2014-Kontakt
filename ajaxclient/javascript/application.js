// Befehle in Function werden direkt ausgef�hrt, ohne Instanziierung
// Achtung: Asynchrone Ausf�hrung der darin enthaltenen Befehle
$(function() {	
	// Registrieren einer Funktion, f�r das gesamte HTML $(document)
	// .ajaxError: speziell bei Fehlern in HTTP Kommunikation
	$(document).ajaxError(function(event, request)
	{	
		if (request.status==400) 
		{
			return; // Spaghetti = True;
		}
	
		//alert(request.statusText); // Status aus Server-Response
		$("#error_dialog").errorDialog("open", request.statusText);
	
		if (request.status==404) 
		{		
			$("#kontakt_liste").show();
			$("#kontakt_details").hide();
			$("#titel_liste").show();
			$("#titel_detail").hide();
			$("#kontakt_liste").kontaktListe("reload");
		}
		
	});
	
	// Bei JEDER ajax-Anfrage wird die GUI zu erst blockiert
	$(document).ajaxStart(function()
	{
		$.blockUI({message:null});
	});
	// Nach Beendigung JEDER ajax-Anfrage wird die UI wieder entsperrt
	$(document).ajaxStop(function()
	{
		$.unblockUI();
	});
	
	// Men�leiste instanziieren
	$("#menu_bar").menuBar(
	{
		onShowKontakteClicked: function() {
			$("#kontakt_liste").show();
			$("#kontakt_details").hide();
			$("#titel_detail").hide();
			$("#titel_liste").show();
			$("#pagesize_selector").show();
			$("#orderby_value").show();
			$("#sort_id").show();
			$("#kontakt_liste").kontaktListe("reload");
		},
		onCreateKontaktClicked: function() {
			$("#kontakt_liste").show();
			$("#titel_liste").show();
			$("#kontakt_details").hide();
			$("#titel_detail").hide();
			$("#create_dialog").createDialog("open");
		},

	}
	);
	
	// HTML Element verkn�pfen und Widget namens "todoList" instanziieren
	$("#kontakt_liste").kontaktListe(
		{
		onKontaktClicked: function(event, kontaktUri)
			{
				$("#kontakt_details").kontaktDetails("load", kontaktUri);
				$("#kontakt_liste").hide();
				$("#titel_liste").hide();
				$("#titel_detail").show();
				$("#kontakt_details").show();
				$("#orderby_value").hide();
				$("#pagesize_selector").hide();
				$("#sort_id").hide();
				//alert(todoUri);
			},
			
		onDeleteKontaktClicked: function(event, kontakt)
			{
				//alert("delete");
				$("#delete_dialog").deleteDialog("open",kontakt);
			},
			
			
		onEditKontaktClicked: function(event, kontakt)
			{
				//alert("in application.js");
				//$("#edit_dialog").show();
				$("#edit_dialog").editDialog("open",kontakt);
				
			},
		onUpKontaktClicked: function() 
			{
				$("#kontakt_liste").kontaktListe("reload",0,"ASC");
			},
		onDownKontaktClicked: function() 
			{	
				$("#kontakt_liste").kontaktListe("reload",0,"DESC");
			},
		onOrderValueClicked: function() 
			{	
				alert("click");
				$("#kontakt_liste").kontaktListe("reload");
			},			
		});
	
	// Weitere Widgets instanziieren:
	$("#error_dialog").errorDialog(); // = jQuery("error_dialog").todoList();
	
	$("#pagesize_selector").kontaktListe(
	{
		onPageClicked: function(event, pagenum)
			{
				$("#kontakt_liste").kontaktListe("reload",pagenum);
			},
	
	});
	
	$("#delete_dialog").deleteDialog(
	{
		onKontaktDeleted: function()
		{
			//alert("wirklich deleted");
			$("#kontakt_liste").kontaktListe("reload");
		}
	});
	
	$("#kontakt_details").kontaktDetails(
	{
	});
	
	$("#edit_dialog").editDialog(
	{		
		onKontaktUpdated: function()
		{
			//alert("success: geupdated");
			$("#kontakt_liste").kontaktListe("reload");
		}
	});
	
	$("#create_dialog").createDialog(
	{		
		onKontaktCreated: function()
		{
			//alert("success: created");
			$("#kontakt_liste").kontaktListe("reload");
		}
	});
	
});