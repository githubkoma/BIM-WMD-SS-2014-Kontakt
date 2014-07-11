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
			$ErrMessage = array();
			
			switch ($errCode)
			{
				case ErrIds::cOK:
					 header("HTTP/1.1 200");
					 break;	
				case ErrIds::cNOK:
					 $ErrMessage = "NotExecute";
					 break;
				case ErrIds::cErrRecordChanged:
					 $ErrMessage = "RecordChanged";
					 header("HTTP/1.1 400");
					 break;	
				case ErrIds::cErrRecordNotFound:
					 $ErrMessage = "RecordNotFound";
					 header("HTTP/1.1 404");
					 break;
				case ErrIds::cErrWrongData:
					 $ErrMessage = "Wrong or missing Data";
					 header("HTTP/1.1 404");
					 break;
				case ErrIds::cErrTableEmpty:
				     header("HTTP/1.1 400");
					 $ErrMessage = "Empty Table";
					 break;
			    case ErrIds::cErrPageNotFound:
					 header("HTTP/1.1 404");
					 $ErrMessage = "PageNotFound";
					 break;				
				case ErrIds::cErrInvalidRequest:
					 header("HTTP/1.1 400");
					 $ErrMessage = "InvalidRequest";
					 break;
				case ErrIds::cErrServerError:
					 header("HTTP/1.1 501");
					 $ErrMessage = "ServerError";
					 break;
				case ErrIds::cErrUndefClass:
					 header("HTTP/1.1 501");
					 $ErrMessage = "Undefined Class";
					 break;
				case ErrIds::cErrWrongParameter:
					 $ErrMessage = "Wrong Parameter";
					 header("HTTP/1.1 400");
					 break;
				case ErrIds::cErrDBConnect:
					 header("HTTP/1.1 500");
					 $ErrMessage = "Connect failed";
					 break;
				case ErrIds::cErrDBClose:
					 header("HTTP/1.1 500");
					 $ErrMessage = "Close failed";
					 break;
				case ErrIds::cErrDBCharset:
					 header("HTTP/1.1 500");
					 $ErrMessage = "Charset failed";
					 break;
				case ErrIds::cErrDBQuery:
					 header("HTTP/1.1 500");
					 $ErrMessage = "Query failed";
					 break;
				case ErrIds::cErrDBFetch:
					 header("HTTP/1.1 500");
					 $ErrMessage = "FetchObject failed";
					 break;
				case ErrIds::cErrDBBFetchRow:
					 header("HTTP/1.1 500");
					 $ErrMessage = "FetchRow failed";
					 break;
				
				case ErrIds::cErrInputNName:
					 header("HTTP/1.1 400");
					
					 $ErrMessage["nname"] = "Fehler in Eingabe: Nachname";
					 break;
				
				case ErrIds::cErrInputVName:
					 header("HTTP/1.1 400");
					 
					 $ErrMessage["vname"] = "Fehler in Eingabe: Vorname";
					 break;
				case ErrIds::cErrInputCompany:
					 header("HTTP/1.1 400");
					 
					 $ErrMessage["company"] = "Fehler in Eingabe: Firma";
					 break;
				
				default: 
					$ErrMessage = "unknown Error: " . $errCode;
					break;
			}
			return $ErrMessage;
		}
		
	}
?>