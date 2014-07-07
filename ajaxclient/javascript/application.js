// Befehle in Function werden direkt ausgeführt, ohne Instanziierung
// Achtung: Asynchrone Ausführung der darin enthaltenen Befehle
$(function() {	
	// Registrieren einer Funktion, für das gesamte HTML $(document)
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
	
	// Menüleiste instanziieren
	$("#menu_bar").menuBar(
	{
		onShowKontakteClicked: function() {
			$("#kontakt_liste").show();
			$("#kontakt_details").hide();
			$("#kontakt_liste").kontaktListe("reload");
		},
		
		onCreateKontaktClicked: function() {
			$("#kontakt_liste").show();
			$("#kontakt_details").hide();
			$("#create_dialog").createDialog("open");
		}
	}
	);
	
	// HTML Element verknüpfen und Widget namens "todoList" instanziieren
	$("#kontakt_liste").kontaktListe(
		{
		onKontaktClicked: function(event, kontaktUri)
			{
				$("#kontakt_details").kontaktDetails("load", kontaktUri);
				$("#kontakt_liste").hide();
				$("#kontakt_details").show();
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
				
			}
						
		});
	
	// Weitere Widgets instanziieren:
	$("#error_dialog").errorDialog(); // = jQuery("error_dialog").todoList();
	
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