<!--- Spezielle Klasse um Anfrage von Kontakts abzufragen !--->

<?php
	
	class GetKontaktCommand 
	{
		public function execute($request)
		{
			if (isset($request["id"]) == FALSE)
			{
				header("HTTP/1.1 400");
				return;
			}
			
			$Kontakt_service = new KontaktService();
			$Kontakt = $Kontakt_service->readKontakt($request);
			
			if ($Kontakt == KontaktService::NOT_FOUND) 
			{
				header("HTTP/1.1 404");
				return;
			}
			
			header("Etag: $Kontakt->cVersion");
			
			//var_dump ($request);			
						
			return $Kontakt;	
		}
		
	}

?>