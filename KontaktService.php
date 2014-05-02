<!--- Domänenspezifische Daten, kein HTML Bezug !--->

<?php
		
	class KontaktService 
	{
		const errC 		 		= "ERROR";
		const errConnect 		= "Connect";
		const NOT_FOUND 		= "NOT_FOUND";
		const INVALID_INPUT 	= "INVALID_INPUT";
		const OK				= "OK";
		const VERSION_OUTDATED 	= "VERSION_OUTDATED";
		
		public function readKontakt($request)
		{						
			$id=$request["id"];
			//var_dump ($id);
						
			// Fetch weist die Attribute anhand des Spaltennamens zu
			$Kontakt = new Kontakt();
						
			switch ($id)
			{
			case 1:
				$Kontakt->cId = $id;
				$Kontakt->cVersion = 5;
				$Kontakt->cVName = "Hans";
				$Kontakt->cNName = "Zimmer";
				break;
				
			case 2:
				$Kontakt->cId = $id;
				$Kontakt->cVersion = 2;
				$Kontakt->cVName = "James";
				$Kontakt->cNName = "Horner";
				break;
			}
									
			if ($Kontakt === NULL or $Kontakt->cId === NULL)
			{
				return self::NOT_FOUND;
			}
		
			unset($Kontakt->id);
			return $Kontakt;
			
		}
		
		public function readKontakte()
		{
			
		} 	
		
		public function createKontakt($Kontakt)
		{	
		
		}
	
		public function deleteKontakt($id)
		{			
			
		}
		
		public function updateKontakt($Kontakt)
		{			
	
		}
	
	}

?>