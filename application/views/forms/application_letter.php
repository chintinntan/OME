<?php
	/**
	 * A PHP function used in overiding default timezone from the PHP.ini 
	 * List of PHP supported timezone is found from this link
	 * Url: http://www.php.net/manual/en/timezones.php
	 */

	$timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);		
												
	$timestamp = time();
 //    for($x=0;$x<count($result);$x++)
	// {
			$acct_username = "Username: ";//.$result[$x]->acct_username;
	        $acct_password = "Password: ";//.$result[$x]->acct_password;
			$acct_name = "Name: ";//.$result[$x]->acct_fName." ".$result[$x]->acct_mName." ".$result[$x]->acct_lName;
			$course = "Course: ";//.$result[$x]->course_id;
	        $dateTime_printed = "Date and Time Printed: ".date("Y-m-d H:i:s", time()-14400);
			
	        $this->pdf->AddPage('P',array(215.9,279.4));
	        $this->pdf->SetFont('Times','',14);
			$this->pdf->MultiCell(0,5, 'University of Immaculate Conception',0,'C');
			$this->pdf->MultiCell(0,5, 'Commission on Elections and Appointments',0,'C');
			$this->pdf->SetFont('Times','',12);
			$this->pdf->MultiCell(0,5, 'Fr. Selga St., Davao City',0,'C');$this->pdf->Ln();
			$this->pdf->MultiCell(0,5, 'Date: ',0,'D');
			$this->pdf->MultiCell(0,5, 'MR. EFRAIM M. OLIVA',0,'D');
			$this->pdf->MultiCell(0,5, 'Chairperson, Commission on Elections and Appointments',0,'D');
			$this->pdf->MultiCell(0,5, 'University of Immaculate Conception',0,'D');
			$this->pdf->Ln();
			$this->pdf->Ln();
			$this->pdf->Ln();
			$this->pdf->MultiCell(0,5, 'Dear Mr. Oliva,',0,'D');
			$this->pdf->Ln();
			$this->pdf->Ln();
			$this->pdf->MultiCell(0,5, 'Praised be Jesus and Mary!,',0,'D');
			$this->pdf->Ln();

			$body_text = "I _______________ of the _______________ Program, would like toinform your good office of my desire to serve my fellow students. In this connection, I would like to formally inform you of my will to run as _______________ (position) of the _________________________ (program/organization) under the party of __________________(party) in the incoming 2014 SSG and Program Election.";

			$this->pdf->MultiCell(0,5, $body_text,0,'J');
			$this->pdf->Ln();
	        $this->pdf->MultiCell(0,5, 'Attached herewith are the requirements:',0,'D');

	        $body_text2 = "
	      -Copy of grades certified by the dean ( 2nd Semester, AY 2011-2012 and 1st Semester, AY 2012-2013) and Class Schedule and Assessment Record(CSAR) of 2nd Semester, AY 2011-2012
						   -Certificate of Candidacy
						   -Certification of good moral character certified by two (2) fulltime faculty members and associate dean
						   -Certification of good moral character certified by the OSAD
						   -Biodata with 2x2 photo
					    -Platform of government";

	        $this->pdf->MultiCell(0,5, $body_text2,0,'J');
	        $this->pdf->Ln();
	        $this->pdf->MultiCell(0,5, 'Your positive response regarding this matter would be highly appreciated.',0,'D');
	        $this->pdf->Ln();
	        $this->pdf->Ln();
	        $this->pdf->MultiCell(0,5, 'Respectfully yours,',0,'D');
	        $this->pdf->Ln();
	        $this->pdf->Ln();
	        $this->pdf->Ln();
	        $this->pdf->MultiCell(0,5, '___________________________',0,'D');
	        $this->pdf->MultiCell(0,5, '   Signature over printed name',0,'D');
	        $this->pdf->Output();
    	//}
?>