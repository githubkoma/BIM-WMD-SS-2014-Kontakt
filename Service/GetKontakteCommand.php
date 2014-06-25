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
			//$errObj = new ErrHandling();
			
			//$retC = $csObj->maxPageCnt($maxPages);
			//var_dump($maxPages);
			
			$Result = $objKontaktService->readKontakte($sqlLimitFrom,  $sqlLimitTo, $sqlOrderBy, $sqlOrderDir);
			
			if ($Result[0] == errIds::cOK)
			{
				//foreach ($arrRecs as $contact)
				//{
				//	//$contact->url = "/bwi2131012/contact/$contact->cId";
				//	$contact->url = "/TeamProject/Service/contact/$contact->cId";
				//	unset($contact->cId);
				//}			
			}
			return $Result;	
		}
		
	}

?>