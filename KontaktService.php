<!--- Domänenspezifische Daten, kein HTML Bezug !--->

<?php		
	//Globale für Sortierung und Richtung
	$gOrderBy  = "cName";
	$gOrderDir = "ASC";
		
	class KontaktService 
	{	
		public function readKontakt($id)
		{	
			$retC = ErrIds::cOK;
			$Result = array(); 
			$Result[0] = $retC;
						
			// Fetch weist die Attribute anhand des Spaltennamens zu
			switch ($id) {
			case 1:
				$Result[1] = new Kontakt();
				$Result[1]->cId = $id;
				$Result[1]->cVersion = 5;
				$Result[1]->cVName = "Hans";
				$Result[1]->cNName = "Zimmer";
				break;
				
			case 2:
				$Result[1] = new Kontakt();
				$Result[1]->cId = $id;
				$Result[1]->cVersion = 2;
				$Result[1]->cVName = "James";
				$Result[1]->cNName = "Horner";
				break;
			}			
			
			if ($Result[1] === NULL or $Result[1]->cId === NULL)
			{
				$Result[0] = errIds::cErrRecordNotFound;
				//echo " ERROR " . $Result[0] . " ERROR ";
				//return $Result[0] = errIds::cErrRecordNotFound;
			}

			unset($Result[1]->id);
			return $Result;
			
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