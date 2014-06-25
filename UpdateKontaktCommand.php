<?php

class UpdateKontaktCommand 
	{
	private $Result = array();
	
	public function execute($request, $request_headers)
	{	
	
		$Result[0] = ErrIds::cOK;	
		
		$Result = $this->CheckParameters($request, $request_headers);			
		if ($Result[0] == ErrIds::cOK)
		{			
			$objKontaktService = new KontaktService();
			$objKontakt = new Kontakt();
			
			//$objKontakt->cCrtUser = "admin2";
			$objKontakt->cUpdtUser = "admin3";
			$objKontakt->cId = $request["id"];
			$objKontakt->cVersion = $request_headers["If-Match"];
			
			$objKontakt->cVName = $request["cVName"];
			$objKontakt->cNName = $request["cNName"];
			$objKontakt->cCompany = $request["cCompany"];
			$objKontakt->cCity = $request["cCity"];
			$objKontakt->cBirthDay = $request["cBirthDay"];
			$objKontakt->cMail = $request["cMail"];
			$objKontakt->cPhone = $request["cPhone"];
		
			$Result = $objKontaktService->updateKontakt($objKontakt);			
			if ($Result[0] == ErrIds::cOK)
			{
				$objKontakt->url = "/githubkoma/BIM-WMD-SS-2014/$objKontakt->cId";
				header("Location: /githubkoma/BIM-WMD-SS-2014/RequestHandler.php?command=GetKontaktCommand&id=XYZ");
				unset($objKontakt->cId);	
				header("HTTP/1.1 201");
			}
			
		}
		
		return $Result;
	}			
	
	private function CheckParameters($request,$request_headers)
	{
		$Result[0] = ErrIds::cOK;
		
		$id = 0;
			
		// Formale Prüfung der Requestsfelder
		if ((isset($request["id"]) !== TRUE) or
			(is_numeric($request["id"]) !== TRUE))
		{
			$Result[0] = errIds::cErrWrongParameter;
		}
		
		if ((isset($request["cVName"]) !== TRUE) or
			($request["cVName"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cNName"]) !== TRUE) or
			($request["cNName"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cCompany"]) !== TRUE) or
			($request["cCompany"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cCity"]) !== TRUE) or
			($request["cCity"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cBirthDay"]) !== TRUE) or
			($request["cBirthDay"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cMail"]) !== TRUE) or
			($request["cMail"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cPhone"]) !== TRUE) or
			($request["cPhone"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request_headers["If-Match"]) !== TRUE) or
			($request_headers["If-Match"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
	
		return $Result;
	
	}
	
	}

?>