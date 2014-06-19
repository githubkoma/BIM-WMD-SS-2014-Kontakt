<?php		
	// Domänenspezifische Daten, kein HTML Bezug

	//Globale für Sortierung und Richtung
	$gOrderBy  = "cName";
	$gOrderDir = "ASC";
	
	class KontaktService 
	{		
		private $Result = array();	
	
		public function readKontakt($id)
		{	
			$Result[0] = ErrIds::cOK;
			
			$objDBcommand = new DBCommand();
			$Result = $objDBcommand->dbConnect();
			
			if ($Result[0] == ErrIds::cOK)
			{							
				$sqlState = 
				"SELECT cId, cCrtDate, cCrtUser, cUpdtDate, " . 
					"cUpdtUser, cNName, cVName, cBirthDay, cCity, " . 
					"cMail, cPhone, cVersion " .
				"FROM ".  $objDBcommand->gTable . " " .
				"WHERE cId = " . $id . 
				";";
				
				// SQL Absetzen, Falls OK: Ergebnis auswerten
				$Result = $objDBcommand->dbQuery($sqlState);
				if ($Result[0] == ErrIds::cOK)
				{
					// Kontaktobjekt als Ergebnis fetchen
					$queryOnly = $Result[1];
					$Result = $objDBcommand->dbFetch($queryOnly);	

				}				
				$objDBcommand->dbClose();				
			}

			unset($Result[1]->id);
			return $Result;
			
		}
		
		public function readKontakte($sqlLimitFrom, $sqlLimitTo, 
										$sqlOrderBy,$sqlOrderDir)
		{
			$Result[0] = ErrIds::cOK;
			
			$objDBcommand = new DBCommand();
			$Result = $objDBcommand->dbConnect();
			
			if ($Result[0] == ErrIds::cOK)
			{							
				$sqlState = 
				"SELECT cId, cCrtDate, cCrtUser, cUpdtDate, " . 
					"cUpdtUser, cNName, cVName, cBirthDay, cCity, " . 
					"cMail, cPhone, cVersion " .
				"FROM ".  $objDBcommand->gTable . " " .
				"ORDER BY " . $sqlOrderBy . " " . $sqlOrderDir . " " .
				"LIMIT " . $sqlLimitFrom . " , " . $sqlLimitTo . 
				";";
			
				$Result = $objDBcommand->dbQuery($sqlState);
				if ($Result[0] == ErrIds::cOK)
				{
					$queryOnly = $Result[1];

					$Result = $objDBcommand->dbFetch($queryOnly);	
					if ($Result[0] == ErrIds::cOK)
					{
					// Erstes Ergebnis des FETCH unverändert lassen, da auch
					// nur ein einziger positiv zurückgegebener Datensatz
					// ein gültiges Ergebnis ist. Daher weiter in Temp-Variable.
						$loopResult = $Result;
						while (($loopResult[0] == ErrIds::cOK))
						{						
							$arrKontaktObjekte[] = $loopResult[1]; 
							$loopResult = $objDBcommand->dbFetch($queryOnly);
						}
					
						$Result[1] = $arrKontaktObjekte;
					}									
				}				
			}
			$objDBcommand->dbClose();
			
			return $Result;
		} 	
		
		public function createKontakt($objKontakt)
		{	
			$Result[0] = ErrIds::cOK;
			
			$objDBcommand = new DBCommand();
			$Result = $objDBcommand->dbConnect();
			if ($Result[0] == ErrIds::cOK)
			{
				$sqlState = "INSERT INTO " . $objDBcommand->gTable . 
							" SET " . 
								"cCrtDate = CURDATE(), " .
								"cCrtUser = '$objKontakt->cCrtUser', " .
								"cUpdtDate = CURDATE(), " .
								"cUpdtUser = '$objKontakt->cUpdtUser', " .
								"cVName = '$objKontakt->cVName', " .
								"cNName = '$objKontakt->cNName', " .
								"cBirthDay = '$objKontakt->cBirthDay', " .
								"cCity = '$objKontakt->cCity', " .
								"cMail = '$objKontakt->cMail', " .
								"cPhone = '$objKontakt->cMail', " .
								"cCompany = '$objKontakt->cCompany', " .
								"cVersion = 1" . 
							";";
													  
				echo $sqlState;
						
				$Result = $objDBcommand->dbQuery($sqlState);
				$objDBcommand->dbClose();

			}
		
			return $Result;
		}
	
		public function deleteKontakt($id)
		{			
			
		}
		
		public function updateKontakt($Kontakt)
		{			
	
		}
	
	}

?>