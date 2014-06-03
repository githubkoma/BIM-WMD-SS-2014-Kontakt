<!--- 
Nur allgemeine Funktionen hier aufrufen 
http://localhost/GitHub/BIM-WMD-SS-2014-Kontakt/RequestHandler.php?command=GetKontaktCommand&id=2
!--->

<?php
	
	require "Kontakt.php";
	require "KontaktService.php";
	require "ErrHandle.php";
	require "ErrIds.php";
	require "GetKontaktCommand.php";	
	#require "CreateKontaktCommand.php";
	#require "CreateKontaktResult.php";
	#require "DeleteKontaktCommand.php";
	#require "UpdateKontaktCommand.php";
	
	// Instanz der Klasse RequestHandler
	$reqHndl = new RequestHandler();	
	// Aufruf der Main Methode zum Starten des Programms
	$reqHndl->handleRequest();
	
	class RequestHandler 
	{
		public function handleRequest()
		{			
			// Error-Handler initialisieren, mit 'OK' starten
			$errObj = new ErrHandle();		
			$retC   = ErrIds::cOK;
			// Result-Array erzeugen, um Rückgabewerte zu strukturieren: 
			// Index [0] = Enthält Return-Code, siehe ErrIds
			// Index [1] = Enthält Ergebnis-Objekt, zur Client-Ausgabe
			$Result = array(); 
			$Result[0] = $retC;						

			// Globale REQUEST Variable übernehmen
			$request = $_REQUEST;			
			// Bei HTTP PUT auch den BODY als Parameter miteinbeziehen
			if ($_SERVER["REQUEST_METHOD"] == "PUT") 
			{
				parse_str(file_get_contents("php://input"), $body_parameters);
				$request = $request + $body_parameters;
			}
			
			// Liefert alle Zeilen des aktuellen HTTP-Requestheaders
			$request_headers = apache_request_headers();
			
			// Dynamischer Klassenaufruf, anhand Key+Value in URL: ?command=xxx
			$class_name = $request["command"];				
			if (class_exists($class_name)) 
			{
				$cmd = new $class_name;
			} 
			else // Klasse nicht vorhanden
			{
				$Result[0] = ErrIds::cErrUndefClass;				
			}
			
			// Angefordertes Kommando ausführen und Ergebnis ausgeben
			if ($Result[0] == ErrIds::cOK)
			{
				$Result = $cmd->execute($request, $request_headers);
				if  ($Result[1] !== NULL) 
				{
					//Formatierung in JSON-Zeichenkette
					echo(json_encode($Result));						
				}
			}
			
			// Fehlerbehandlung -> Auswerten, Ausgeben, HTTP Header setzen 
			If ($Result[0] !== ErrIds::cOK) 
			{					
				$errText = $errObj->getError($Result[0]);
				var_dump("ErrorCode:",$Result[0]," ",$errText);
				var_dump("Message: ",$errObj->validationMessage);	
			}
		}
	}		
?>	