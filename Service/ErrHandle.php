<?php

	//Klassen sind immer public
	//Eigenschaften können private, public, protected
	class ErrHandle
	{	
		public $ErrMessage;	
		public $validationMessage = array();
		
		public function getError($errCode)
		{
			global $link;
		
			switch ($errCode)
			{
				case ErrIds::cNOK:
					 $ErrMessage = array();
					 $ErrMessage["error"] = "NotExecute";
					 break;
				case ErrIds::cErrRecordChanged:
					 header("HTTP/1.1 412");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "RecordChanged: " . $errCode;				 
					 break;	
				case ErrIds::cErrRecordNotFound:
					 $ErrMessage = array();
					 $ErrMessage["error"] = "RecordNotFound: " . $errCode;
					 header("HTTP/1.1 404");
					 break;
				case ErrIds::cErrWrongData:
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Wrong or missing Data: " . $errCode;
					 break;
				case ErrIds::cErrTableEmpty:
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Empty Table" . $errCode;
					 break;
			    case ErrIds::cErrPageNotFound:
					 $ErrMessage = array();
					 $ErrMessage["error"] = "PageNotFound";
					 break;				
				case ErrIds::cErrInvalidRequest:
					 $ErrMessage = array();
					 $ErrMessage["error"] = "InvalidRequest";
					 break;
				case ErrIds::cErrServerError:
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "ServerError";
					 break;
				case ErrIds::cErrUndefClass:
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Undefined Class: " . $errCode;
					 break;
				case ErrIds::cErrWrongParameter:
					 header("HTTP/1.1 400");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Wrong Parameter: " . $errCode;
					 break;
				case ErrIds::cErrDBConnect:
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Connect failed: " . $link->connect_error . ": " . $link->connect_errno;
					 break;
				case ErrIds::cErrDBClose:
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Close failed: " . $errCode;
					 break;
				case ErrIds::cErrDBCharset:
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Charset failed: " . $errCode;
					 break;
				case ErrIds::cErrDBQuery:
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "Query failed: " . $errCode;
					 break;
				case ErrIds::cErrDBFetch:
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "FetchObject failed: " . $errCode;
					 break;
				case ErrIds::cErrDBBFetchRow:
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "FetchRow failed: " . $errCode;
					 break;
				
				
				case ErrIds::cErrInputNName:
					 header("HTTP/1.1 400");
					 $ErrMessage = array();
					 $ErrMessage["nname"] = "Fehler in Eingabe: Nachname";
					 break;
				
				case ErrIds::cErrInputVName:
					 header("HTTP/1.1 400");
					 $ErrMessage = array();
					 $ErrMessage["vname"] = "Fehler in Eingabe: Vorname";
					 break;
				case ErrIds::cErrInputCompany:
					 header("HTTP/1.1 400");
					 $ErrMessage = array();
					 $ErrMessage["company"] = "Fehler in Eingabe: Firma";
					 break;
				
				default: 
					 header("HTTP/1.1 500");
					 $ErrMessage = array();
					 $ErrMessage["error"] = "unknown Error: " . $errCode;
					 break;
			}
			return $ErrMessage;
		}
		
	}
?>