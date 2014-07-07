<?php
	
	// Nur allgemeine Funktionen hier aufrufen
	//http://localhost/GitHub/BIM-WMD-SS-2014-Kontakt/RequestHandler.php?command=GetKontaktCommand&id=2
	
	require "Kontakt.php";
	require "KontaktService.php";
	require "ErrHandle.php";
	require "ErrIds.php";
	require "DBCommand.php";
	require "GetKontaktCommand.php";	
	require "GetKontakteCommand.php";	
	require "CreateKontaktCommand.php";
	require "DeleteKontaktCommand.php";
	require "UpdateKontaktCommand.php";
	
	// Instanz der Klasse RequestHandler
	$reqHndl = new RequestHandler();	
	// Aufruf der Main Methode zum Starten des Programms
	$reqHndl->handleRequest();
	
	class RequestHandler 
	{
		// Result-Array erzeugen, um Rückgabewerte zu strukturieren: 
		// Index [0] = Enthält Return-Code, siehe ErrIds
		// Index [1] = Enthält Ergebnis-Objekt bei jeglichen Aufrufen
		private $Result = array();	
	
		public function handleRequest()
		{			
			// Error-Handler initialisieren, mit 'OK' starten
			$errObj = new ErrHandle();
			$Result[0] = ErrIds::cOK;				
			
			// Globale REQUEST Variable übernehmen
			$request = $_REQUEST;			
			// Bei allem außer HTTP PUT enthält der Request schon den BODY
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
				if  ($Result[0] == ErrIds::cOK) 
				{
					if  ($Result[1] !== NULL) 
					{
						//Formatierung in JSON-Zeichenkette
						//header("HTTP/1.1 200");
						echo(json_encode($Result[1]));						
					}
				}
			}
			
			// Fehlerbehandlung -> Auswerten, Ausgeben, HTTP Header setzen 
			If ($Result[0] !== ErrIds::cOK) 
			{					
				$errText = $errObj->getError($Result[0]);
				echo(json_encode($errText));
				//var_dump("ErrorCode:",$Result[0]," ",$errText);
				//var_dump("Message: ",$errObj->validationMessage);	
			}
		}
	}		
?>	