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
					
			$sqlLimitFrom 	= 0;
			$sqlLimitTo 	= 5;
			$sqlElemPage 	= 5;
			$sqlOrderBy 	= "cNName"; ;
			$sqlOrderDir 	= "ASC";			
			
			$objKontaktService = new KontaktService();
			
			//$Result = $objKontaktService->maxPageCnt($maxPages);
			
			$Result = $objKontaktService->readKontakte($sqlLimitFrom,  $sqlLimitTo, $sqlOrderBy, $sqlOrderDir);
			
			if ($Result[0] == errIds::cOK)
			{
				foreach ($Result[1] as $Kontakt)
				{
					$Kontakt->url = "/BIM-WMD-SS-2014-Kontakt/Service/Kontakte/$Kontakt->cId";
					
					unset($Kontakt->cId);
				}
				
				$PageResult = $objKontaktService->maxPageCnt($sqlElemPage);
				if  (($PageResult[0] == errIds::cOK) and ($PageResult[1] > 0))
				{				
					header("PageSize: $PageResult[1]");
				};
			}
			return $Result;	
		}
		
	}

?>