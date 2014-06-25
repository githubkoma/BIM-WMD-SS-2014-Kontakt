
<?php
	
	// Spezielle Klasse um Anfrage von Kontakts abzufragen
	
	class DeleteKontaktCommand 
	{
		private $Result = array();	
	
		public function execute($request,$requestHeaders)
		{
			//Initialisieren
			$Result[0] = ErrIds::cOK;				
			$id = 0;

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
				$Result = $objKontaktService->deleteKontakt($Id);
				
				if ($Result[0] == errIds::cOK)
				{						
					header("HTTP/1.1 201");
					header("Location: /BIM-WMD-SS-2014-Kontakt/Service/Kontakte");
				}
			
			}
				
			return $Result;	
		}
		
	}

?>