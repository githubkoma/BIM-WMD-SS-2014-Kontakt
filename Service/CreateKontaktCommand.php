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
			
			var_dump($request);
			
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
				$objKontakt->url = "/BIM-WMD-SS-2014/Service/Kontakte";
				//$TempURL = $objKontakt->url;
				header("Location: $objKontakt->url");
				header("HTTP/1.1 201");
				unset($objKontakt->cId);			
			}
			
		}
		
		return $Result;
	}			
	
	private function CheckParameters($request)
	{
		$Result[0] = ErrIds::cOK;
		
		// Formale Prüfung der Requestsfelder
		if ((isset($request["cVName"]) !== TRUE) or
			($request["cVName"]) == NULL)
		{
			$Result[0] = ErrIds::cErrInputVName;
		}
		
		if ((isset($request["cNName"]) !== TRUE) or
			($request["cNName"]) == "")
		{
			$Result[0] = ErrIds::cErrInputNName;
		}
		
		if ((isset($request["cCompany"]) !== TRUE) or
			($request["cCompany"]) == NULL)
		{
			$Result[0] = ErrIds::cErrInputCompany;
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
	
		return $Result;
	
	}
	
	}

?>