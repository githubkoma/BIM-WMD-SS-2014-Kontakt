<?php

	class DBCommand
	{		
		public $gDbName		= "cmdb";
		public $gTable 		= "contacts";
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
			global $gLink;
			
			$retC = $gLink->close();
			if ($retC == FALSE)
			{
				return ErrIds::cErrClose;
			}
			return ErrIds::cOK;
		}	
		
		public function dbCharSet()
		{
			global $gLink;
			
			$retC = $gLink->set_charset("utf8");
			if ($retC === FALSE)
			{
				return ErrIds::cErrDBCharset;
			}
			return ErrIds::cOK;
		}
		
		public function dbQuery($sqlState)
		{
			$Result[0] =  ErrIds::cOK;
		
			// Rückgabewert aus mysqli::query ist eine Klasse
			$queryResult = $this->gLink->query($sqlState);		
			if  ($queryResult === FALSE)
			{
				$Result[0] = ErrIds::cErrDBQuery;
			}
			else
			{
				$fetchResult = $queryResult->fetch_object();		
			
				switch ($fetchResult) {
				case FALSE:
					$Result[0] = ErrIds::cErrDBFetch;
					break;
					
				case FALSE:
					$Result[0] = ErrIds::cErrDBFetch;
					break;
					
				default:
					$Result[1] = $fetchResult;				
				}				
				
			}			
			
			return $Result;
		}
		
		public function dbFetch($resSet,&$dbRec,$tab)
		{

			$dbRec     = $resSet->fetch_object($tab);		
			if  ($dbRec === FALSE)
			{
				return ErrIds::cErrDBFetch;
			} else if ($dbRec == NULL)
				{
					return ErrIds::cErrRecordNotFound;
				}
			
			return ErrIds::cOK;
		}
		
		public function dbFetchRow($resSet,&$dbRec)
		{
			
			$dbRec = $resSet->fetch_row();
			if  ($dbRec === FALSE)
			{
				return ErrIds::cErrTableEmpty;
			} else if ($dbRec == NULL)
				{
					return ErrIds::cErrDBBFetchRow;
				}
			
			return ErrIds::cOK;
		}
	}
?>