<!--- 
Nur allgemeine Funktionen hier aufrufen 
http://localhost/githubkoma/Service/Kontakts?command=GetKontaktCommand&id=2
!--->

<?php
	
	require "Kontakt.php";
	require "KontaktService.php";
	require "GetKontaktCommand.php";
	#require "GetKontaktCommand.php";
	#require "CreateKontaktCommand.php";
	#require "CreateKontaktResult.php";
	#require "DeleteKontaktCommand.php";
	#require "UpdateKontaktCommand.php";
	
	//Instanz der Klasse RequestHandler
	$reqHndl = new RequestHandler();	
	//Aufruf der Methode der Klasse ReqHandler
	$reqHndl->handleRequest();
	
	class RequestHandler 
	{
		public function handleRequest()
		{
			//Instanz bzw. Konstruktor und initialisierung
			//$cmd = new GetKontaktCommand();
						
			$request = $_REQUEST;
			
			if ($_SERVER["REQUEST_METHOD"] == "PUT") {
				parse_str(file_get_contents("php://input"), $body_parameters);
				$request = $request + $body_parameters;
			}			
			
			$request_headers = apache_request_headers();
			
			$class_name = $request["command"];	
			
			if (class_exists($class_name));
			{
				$cmd = new $class_name;
				$Kontakt = $cmd->execute($request, $request_headers);
				if  ($Kontakt !== NULL) 
				{
					//formatierung in JSON-Zeichenkette
					echo(json_encode($Kontakt));	
					//var_dump($Kontakt);
				}
			}
		}
	}

		
?>	