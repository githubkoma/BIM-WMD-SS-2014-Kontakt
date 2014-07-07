<?php

class CreateKontaktCommand 
	{
	private $Result = array();
	
	public function execute($request,$requestHeaders)
	{	
		$Result[0] = ErrIds::cOK;	
		
		$Result = $this->CheckParameters($request);			
		if ($Result[0] == ErrIds::cOK)
		{
			$objKontaktService = new KontaktService();
			$objKontakt = new Kontakt();
			
			$objKontakt->cCrtUser = "admin2";
			//$objKontakt->cUpdtUser = "admin2";
			//objKontakt->cCrtUser = $_SERVER["PHP_AUTH_USER"];
			//Passwort: $_SERVER["PHP_AUTH_PW"];
			
			$objKontakt->cVName = $request["cVName"];
			$objKontakt->cNName = $request["cNName"];
			$objKontakt->cCompany = $request["cCompany"];
			$objKontakt->cCity = $request["cCity"];
			$objKontakt->cBirthDay = $request["cBirthDay"];
			$objKontakt->cMail = $request["cMail"];
			$objKontakt->cPhone = $request["cPhone"];
			
			$Result = $objKontaktService->createKontakt($objKontakt);
			if ($Result[0] == ErrIds::cOK)
			{
				header("Location: /BIM-WMD-SS-2014/Service/Kontakte");
				header("HTTP/1.1 201");				
			}
			
		}
		
		return $Result;
	}			
	
	private function CheckParameters($request)
	{
		$Result[0] = ErrIds::cOK;
		
		// Formale Prüfung der Requestsfelder
		if ((isset($request["cNName"]) !== TRUE) or
			($request["cNName"]) == "")
		{
			$Result[0] = ErrIds::cErrInputNName;
			return $Result;
		}

		if ((isset($request["cVName"]) !== TRUE) or
			($request["cVName"]) == NULL)
		{
			$Result[0] = ErrIds::cErrInputVName;
			return $Result;
		}
		
		if ((isset($request["cCompany"]) !== TRUE) or
			($request["cCompany"]) == NULL)
		{
			$Result[0] = ErrIds::cErrInputCompany;
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