<?php

	class DBCommand
	{		
		public $gDbName		= "cmdb";
		public $gTable 		= "kontakt";
		private $gHost	 	= "localhost";
		private $gUser		= "root";
		private $gPassW 	= "";	
		private $gLink;
		
		private $Result = array();		
		
		function __construct() 
		{			
			//$Result[0] =  ErrIds::cOK;
		}
		
		public function dbConnect()
		{
			$Result[0] =  ErrIds::cOK;
		
			@$this->gLink = new mysqli($this->gHost,$this->gUser,$this->gPassW,$this->gDbName);
			
			if  ($this->gLink->connect_error != NULL)
			{				
				$Result[0] = ErrIds::cErrDBConnect;				
			}
			else // Kein Connect-Fehler
			{
				$Result[1] = $this->gLink->set_charset("utf8");	
				If ($Result[1] === FALSE) // Charset setzen missglueckt?
				{
					$Result[0] = ErrIds::cErrDBCharset;			
				}			
				
			}	
			return $Result;
		}
		
		public function dbClose()
		{
			$Result[0] =  ErrIds::cOK;
			
			$Result[1] = $this->gLink->close();
			if ($Result[1] == FALSE)
			{
				$Result[0] = ErrIds::cErrClose;
			}
			return $Result;
		}	
	
		public function dbQuery($sqlState)
		{
			$Result[0] =  ErrIds::cOK;
		
			// Rückgabewert aus mysqli::query ist eine Klasse
			$Result[1] = $this->gLink->query($sqlState);		
			if  ($Result[1] === FALSE)
			{
				$Result[0] = ErrIds::cErrDBQuery;
			}

			return $Result;
		}
		
		public function dbFetch($query)
		{
			$Result[0] =  ErrIds::cOK;

			// Fetch: Datensatz Lesen und Zeiger vorwärts setzen
			$Result[1] = $query->fetch_object("kontakt");
				
			switch ($Result[1]) {
			case FALSE:
				$Result[0] = ErrIds::cErrRecordNotFound;
				break;
			case NULL:
				$Result[0] = ErrIds::cErrDBFetch;
				break;
			}				
			return $Result;
		}
		
		public function dbFetchRow($query)
		{
			$Result[0] =  ErrIds::cOK;
			
			$Result[1] = $query->fetch_row();
			if  ($Result[1] === FALSE)
			{
				$Result[0] = ErrIds::cErrTableEmpty;
			} else if ($Result[1] == NULL)
				{
					$Result[0] = ErrIds::cErrDBBFetchRow;
				}
			
			return $Result;
		}
	}
?>