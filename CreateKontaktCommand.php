<?php

class CreateKontaktCommand 
	{
		private $Result = array();
		
		public function execute($request,$requestHeaders)
		{	
			$Result[0] = ErrIds::cOK;	

			if ((isset($request["cVName"]) == TRUE) and
				(isset($request["cNName"]) == TRUE) and
				(isset($request["cCompany"]) == TRUE) and
				(isset($request["cCity"]) == TRUE) and
				(isset($request["cBirthDay"]) == TRUE) and
				(isset($request["cMail"]) == TRUE) and
				(isset($request["cPhone"]) == TRUE))
			{
						
			} else
			{
				$Result[0] = ErrIds::cErrWrongParameter;
			}
						
			$objKontaktService = new KontaktService();
			
			var_dump($request); 
			
			return $Result;
		}			
	
	}

?>