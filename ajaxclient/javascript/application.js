// Befehle in Function werden direkt ausgef�hrt, ohne Instanziierung
// Achtung: Asynchrone Ausf�hrung der darin enthaltenen Befehle
$(function() {	
	// Registrieren einer Funktion, f�r das gesamte HTML $(document)
	// .ajaxError: speziell bei Fehlern in HTTP Kommunikation
	$(document).ajaxError(function(event, request)
	{
		//alert(request.statusText); // Status aus Server-Response
		$("#error_dialog").errorDialog("open", request.statusText);
		$("#kontakt_liste").show();
		$("#kontakt_details").hide();
		
		if (request.status==404) 
		{
			$("#kontakt_liste").kontaktListe("reload");
		}
		
	});
	
	
	// HTML Element verkn�pfen und Widget namens "todoList" instanziieren
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
			}
			
		});
	
	// Weitere Widgets instanziieren:
	$("#error_dialog").errorDialog(); // = jQuery("error_dialog").todoList();
	$("#delete_dialog").deleteDialog(
	{
		onKontaktDeleted: function()
		{
			alert("wirklich deleted");
			$("#kontakt_liste").kontaktListe("reload");
		}
	});
	$("#kontakt_details").kontaktDetails();
	
});