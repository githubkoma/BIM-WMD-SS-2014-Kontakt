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
				//$objKontakt->url = "/BIM-WMD-SS-2014/Service/Kontakte/$objKontakt->cId";
				//$TempURL = $objKontakt->url;
				//header("Location: $TempURL");
				header("HTTP/1.1 201");
				unset($objKontakt->cId);
			}
			
		}
		
		return $Result;
	}			
	
	private function CheckParameters($request,$request_headers)
	{
		$Result[0] = ErrIds::cOK;
		
		$id = 0;
		
		var_dump($request);
		
		// Formale Prüfung der Requestsfelder
		if ((isset($request["id"]) !== TRUE) or
			(is_numeric($request["id"]) !== TRUE))
		{
			echo "1";
			$Result[0] = errIds::cErrWrongParameter;
		}
		
		if ((isset($request["cVName"]) !== TRUE) or
			($request["cVName"]) == NULL)
		{
			echo "2";
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cNName"]) !== TRUE) or
			($request["cNName"]) == NULL)
		{
			echo "3";
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cCompany"]) !== TRUE) or
			($request["cCompany"]) == NULL)
		{
			echo "4";
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		/*if ((isset($request["cCity"]) !== TRUE) or
			($request["cCity"]) == NULL)
		{
			echo "5";
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cBirthDay"]) !== TRUE) or
			($request["cBirthDay"]) == NULL)
		{
			echo "6";
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cMail"]) !== TRUE) or
			($request["cMail"]) == NULL)
		{
			echo "7";
			$Result[0] = ErrIds::cErrWrongParameter;
		}
		
		if ((isset($request["cPhone"]) !== TRUE) or
			($request["cPhone"]) == NULL)
		{
			echo "8";
			$Result[0] = ErrIds::cErrWrongParameter;
		}*/
		
		if ((isset($request_headers["If-Match"]) !== TRUE) or
			($request_headers["If-Match"]) == NULL)
		{
			echo "9";
			$Result[0] = ErrIds::cErrWrongParameter;
		}
	
		return $Result;
	
	}
	
	}

?>