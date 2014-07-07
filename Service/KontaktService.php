<?php		
	// Domänenspezifische Daten, kein HTML Bezug	
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
					"cUpdtUser, cNName, cVName, cBirthDay, cCompany, cCity, " . 
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
					"cUpdtUser, cNName, cVName, cBirthDay, cCompany, cCity, " . 
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
								"cPhone = '$objKontakt->cPhone', " .
								"cCompany = '$objKontakt->cCompany', " .
								"cVersion = 1" . 
							";";
						
				echo $sqlState;
						
				$Result = $objDBcommand->dbQuery($sqlState);
				$objDBcommand->dbClose();

			}
		
			return $Result;
		}
	
		public function deleteKontakt($objKontakt)
		{	
			$Result[0] = ErrIds::cOK;
			
			$objDBcommand = new DBCommand();
			$Result = $objDBcommand->dbConnect();
			if ($Result[0] == ErrIds::cOK)
			{
				// Prüfen, ob der Datensatz überhaupt besteht
				$Result = $this->readKontakt($objKontakt->cId);
				if ($Result[0] == ErrIds::cOK)
				{		
					// Datensatz darf sich zwischenzeitlich nicht geändert haben
					If ($Result[1]->cVersion == $objKontakt->cVersion)
					{
						$sqlState = 
							"DELETE FROM " . $objDBcommand->gTable . " " . 
							"WHERE cId = " . $objKontakt->cId .
							";";
						
							//echo $sqlState;
					
							$Result = $objDBcommand->dbQuery($sqlState);
					} else
					{
						$Result[0] = ErrIds::cErrRecordChanged;
					}
					
				} else 
				{
					$Result[0] = ErrIds::cErrRecordNotFound;
				}
				
				$objDBcommand->dbClose();
			}
			return $Result;
		}
		
		public function updateKontakt($objKontakt)
		{			
			$Result[0] = ErrIds::cOK;
			
			$objDBcommand = new DBCommand();
			$Result = $objDBcommand->dbConnect();
			if ($Result[0] == ErrIds::cOK)
			{
				// Prüfen, ob der Datensatz überhaupt besteht
				$Result = $this->readKontakt($objKontakt->cId);
				if ($Result[0] == ErrIds::cOK)
				{						
					// Datensatz darf sich zwischenzeitlich nicht geändert haben
					If ($Result[1]->cVersion == $objKontakt->cVersion)
					{
						$sqlState = 
						"UPDATE " . $objDBcommand->gTable . " " . 
						"SET " . 
							"cUpdtDate = CURDATE(), " .
							"cUpdtUser = '$objKontakt->cUpdtUser', " .
							"cVName = '$objKontakt->cVName', " .
							"cNName = '$objKontakt->cNName', " .
							"cBirthDay = '$objKontakt->cBirthDay', " .
							"cCity = '$objKontakt->cCity', " .
							"cMail = '$objKontakt->cMail', " .
							"cPhone = '$objKontakt->cPhone', " .
							"cCompany = '$objKontakt->cCompany', " .
							"cVersion = cVersion + 1 " . 
						"WHERE cId = " . $objKontakt->cId . " " .
						";";
															  
						echo $sqlState;
								
						$Result = $objDBcommand->dbQuery($sqlState);

					} else
					{
						$Result[0] = ErrIds::cErrRecordChanged;
					}
				
				}				
				
				$objDBcommand->dbClose();

			}
		
			return $Result;
		}
		
		//Anzahl der Seiten ermitteln
		public function maxPageCnt(&$maxPages)
		{
			$Result[0] = ErrIds::cOK;
			
			$objDBcommand = new DBCommand();
			$Result = $objDBcommand->dbConnect();
			
			if ($Result[0] == ErrIds::cOK)
			{			
				$sqlState = "SELECT COUNT(*) 
							 FROM " . $objDBcommand->gTable . ";";
				
				$Result = $objDBcommand->dbQuery($sqlState);
				
				var_dump($Result);
				
				if  ($Result[0] == ErrIds::cOK)
				{
					$Result[1] = $objDBcommand->dbFetchRow($resSet,$dbRec);
					if  ($Result[0] == ErrIds::cOK)
					{
						$dbRec 	  = $dbRec[0];
						$maxPages = ceil($dbRec / $sqlLimitTo); 
					}
				}
			
			}
			
			$objDBcommand->dbClose();
			return $Result;
		}
	
	}

?>