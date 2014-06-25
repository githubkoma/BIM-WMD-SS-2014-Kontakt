
<?php
	
	// Spezielle Klasse um Anfrage von Kontakts abzufragen
	
	class GetKontaktCommand 
	{
		private $Result = array();	
	
		public function execute($request,$requestHeaders)
		{
			//Initialisieren
			$Result[0] = ErrIds::cOK;				
			$id = 0;
			
			// Formale Prüfung der Request ID
			// Vorhanden? Nur Zahlenwert? etc.
			if (isset($request["id"])) {
			
				if  (is_numeric($request["id"]))
				{
					$Id  = $request["id"];
				} 
				else 
				{
					$Result[0] = errIds::cErrWrongParameter;
				}
			} 
			else 
			{
				$Result[0] = errIds::cErrWrongParameter;
			}				
			
			// Kein Fehler bis hier hin? -> Verarbeitung starten
			if ($Result[0] == errIds::cOK) 
			{
				$objKontaktService = new KontaktService();
				$Result = $objKontaktService->readKontakt($Id);
				
				if ($Result[0] == errIds::cOK)
				{						
					$Result[1]->url = "/TeamProject/Service/contact/$Id";
					unset($Result[1]->cId);
					$TempVersion = $Result[1]->cVersion;
					header("Etag: $TempVersion");
					unset($Result[1]->cVersion);
				}
			
			}
				
			return $Result;	
		}
		
	}

?>