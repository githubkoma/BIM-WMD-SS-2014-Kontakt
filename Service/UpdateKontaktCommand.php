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
			
			//$objKontakt->cUpdtUser = "admin3";
			$objKontakt->cUpdtUser = $_SERVER["PHP_AUTH_USER"];
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
				$objKontakt->url = "/BIM-WMD-SS-2014/Service/Kontakte/$objKontakt->cId";
				$Result[1] = $objKontakt;
				//$TempURL = $objKontakt->url;
				//header("Location: $TempURL");
				header("HTTP/1.1 201");
				unset($Result[1]->cId);
			}
			
		}
		return $Result;
	}			
	
	private function CheckParameters($request,$request_headers)
	{
		$Result[0] = ErrIds::cOK;
		
		//var_dump($request);
		
		// Formale Prüfung der Requestsfelder
		if ((isset($request["id"]) !== TRUE) or
			(is_numeric($request["id"]) !== TRUE))
		{
			$Result[0] = errIds::cErrWrongParameter;
			return $Result;
		}
		
		if ((isset($request["cVName"]) !== TRUE) or
			($request["cVName"]) == NULL)
		{
			$Result[0] = ErrIds::cErrInputVName;
			return $Result;
		}
		
		if ((isset($request["cNName"]) !== TRUE) or
			($request["cNName"]) == "")
		{
			$Result[0] = ErrIds::cErrInputNName;
			return $Result;
		}
		
		if ((isset($request["cCompany"]) !== TRUE) or
			($request["cCompany"]) == NULL)
		{
			$Result[0] = ErrIds::cErrInputCompany;
			return $Result;
		}
		
		if ((isset($request_headers["If-Match"]) !== TRUE) or
			($request_headers["If-Match"]) == NULL)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
			return $Result;
		}
		
		if (isset($request["cCity"]) !== TRUE)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if (isset($request["cBirthDay"]) !== TRUE) 
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if (isset($request["cMail"]) !== TRUE) 
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if (isset($request["cPhone"]) !== TRUE)
		{
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		return $Result;
	
	}
}

?>