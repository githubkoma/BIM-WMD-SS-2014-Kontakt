<?php
	//Klassen sind immer public
	//Eigenschaften können private, public, protected
	class Kontakt
	{
		public $vHost	= "localhost";
		public $vUser	= "root";
		public $vPassW 	= "";
		public $vDB		= "kontaktliste";
		public $vTable  = "kontakte";
		
		public $cId;
		public $cCrtDate;
		public $cCrtUser;
		public $cUpdtDate;
		public $cUpdtUser;
		public $cVName;
		public $cNName;
		public $cCompany;
		public $cBirthDay;
		public $cMail;
		public $cPhone;
		
		public $vReturnCode;
		public $vErrMessage;
		
		const  cErrOK				= 0;
		const  cErrNOK          	= 1;
		const  cErrPageNotFound 	= 10;
		const  cErrInvalidRequest	= 11;
		const  cErrServerError		= 12;
		const  cErrRecordNotFound	= 13;
		const  cErrDBConnect    	= 101;
		const  cErrDBCharset    	= 102;
		const  cErrDBQuery      	= 103;
		const  cErrDBFetch      	= 103;
		
	}
?>