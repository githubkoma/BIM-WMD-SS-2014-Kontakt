<?php
	//Globale für SQL
	$sqlLimitFrom;			//ab welchem Record gelsen werden soll init=0
	$sqlLimitTo;			//Anzahl Records die gelesen werden

	class GetKontakteCommand 
	{
		private $Result = array();	
		
		public function execute($request,$requestHeaders)
		{
			//Initialisieren
			$Result[0] = ErrIds::cOK;	
					
			$sqlLimitFrom = 0;
			$sqlLimitTo = 20;
			$sqlOrderBy = "cNName"; ;
			$sqlOrderDir = "ASC";			
			
			$objKontaktService = new KontaktService();
			
			//$Result = $objKontaktService->maxPageCnt($maxPages);
			
			$Result = $objKontaktService->readKontakte($sqlLimitFrom,  $sqlLimitTo, $sqlOrderBy, $sqlOrderDir);
			
			if ($Result[0] == errIds::cOK)
			{
				foreach ($Result[1] as $Kontakt)
				{
					$Kontakt->url = "/ProjectDebug/Service/Kontakte/$Kontakt->cId";
					unset($Kontakt->cId);
				}
			}
			return $Result;	
		}
		
	}

?>