
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
				
				//if ($Result[0] == errIds::cOK)
				//{
				//	return $Result;
				//}
				//$dbRec->url = "/TeamProject/Service/contact/$dbRec->cId";
				//	unset($dbRec->cId);
				//	header("Etag: $dbRec->cVersion");
				//	unset($dbRec->cVersion);
				//}
			
				//if ($Kontakt == KontaktService::NOT_FOUND) 
				//{
				//	header("HTTP/1.1 404");
				//	return;
				//}
			
			}
			
			// header("Etag: $Kontakt->cVersion");
				
			return $Result;	
		}
		
	}

?>