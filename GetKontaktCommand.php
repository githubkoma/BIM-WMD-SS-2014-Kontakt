<!--- Spezielle Klasse um Anfrage von Kontakts abzufragen !--->

<?php
	
	class GetKontaktCommand 
	{
		public function execute($request,$requestHeaders)
		{
			//Initialisieren
			$retC = ErrIds::cOK;
			$Result = array(); 
			$Result[0] = $retC;						
			$id = 0;
			
			// Formale Pr�fung der Request ID
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
				$Kontakt_service = new KontaktService();
				$Result = $Kontakt_service->readKontakt($Id);
				
				if ($Result[0] == errIds::cOK)
				{
					return $Result;
				}
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