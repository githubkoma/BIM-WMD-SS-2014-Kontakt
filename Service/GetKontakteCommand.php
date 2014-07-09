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
			$sqlElemPage 	= 20;
			$sqlOrderBy 	= "cNName";
			$sqlOrderDir 	= "ASC";			
			
			$objKontaktService = new KontaktService();
			
			if ((isset($requestHeaders["RecordFrom"]) === TRUE) and
				($requestHeaders["RecordFrom"]) != NULL)
			{
				$sqlLimitFrom  = $requestHeaders["RecordFrom"];
			}
			if ((isset($requestHeaders["PageSize"]) === TRUE) and
				($requestHeaders["PageSize"]) != NULL)
			{
				$sqlElemPage = $requestHeaders["PageSize"];
			}
			if ((isset($requestHeaders["OrderBy"]) === TRUE) and
				($requestHeaders["OrderBy"]) != NULL)
			{
				$sqlOrderBy = $requestHeaders["OrderBy"];
			}
			if ((isset($requestHeaders["OrderDir"]) === TRUE) and
				($requestHeaders["OrderDir"]) != NULL)
			{
				$sqlOrderDir = $requestHeaders["OrderDir"];
			}

			$Result = $objKontaktService->readKontakte($sqlLimitFrom,  $sqlElemPage, $sqlOrderBy, $sqlOrderDir);
			
			if ($Result[0] == errIds::cOK)
			{
				foreach ($Result[1] as $Kontakt)
				{
					$Kontakt->url = "/BIM-WMD-SS-2014-Kontakt/Service/Kontakte/$Kontakt->cId";
					
					unset($Kontakt->cId);
				}
				
				header("RecordFrom: $sqlLimitFrom");
				
				if  ($sqlLimitFrom == 0) //soll nur beim ersten mal mitgelifert werden
				{
					$PageResult = $objKontaktService->maxPageCnt($sqlElemPage);
					if  (($PageResult[0] == errIds::cOK) and ($PageResult[1] > 0))
					{				
						header("PageSize: $PageResult[1]");
					};
				}
			}
			return $Result;	
		}
		
	}

?>