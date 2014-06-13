<!--- Domänenspezifische Daten, kein HTML Bezug !--->

<?php		
	//Globale für Sortierung und Richtung
	$gOrderBy  = "cName";
	$gOrderDir = "ASC";
	
	class KontaktService 
	{		
		private $Result = array();	
	
		public function readKontakt($id)
		{	
			$Result[0] = ErrIds::cOK;
			
			$objDB = new DBCommand();
			$Result = $objDB->dbConnect();
			
			if ($Result[0] == ErrIds::cOK)
			{
				$sqlState = "SELECT cId, cCrtDate, cCrtUser, cUpdtDate, " . 
				"cUpdtUser, cName, cBirthDay, cCity, " . 
				"cMail, cNotes " . // !!! cVersion !!!
				"FROM ".  $objDB->gTable . " " .
				"WHERE cId = " . $id . ";";
				
				$Result = $objDB->dbQuery($sqlState);
			
			}
		
			// Keinen Datensatz zurückbekommen?
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