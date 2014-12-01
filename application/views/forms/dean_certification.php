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
		$this->pdf->MultiCell(0,5, 'College Department',0,'C');
		$this->pdf->SetFont('Times','',12);
		$this->pdf->MultiCell(0,5, 'Davao City',0,'C');$this->pdf->Ln();
		$this->pdf->SetFont('Times','',16);
		$this->pdf->Ln();$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, 'C E R T I F I C A T I O N',0,'C');$this->pdf->Ln();
		$this->pdf->SetFont('Times','',12);
		$this->pdf->MultiCell(0,5, 'To Whom it May Concern:',0,'D');
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, '											This is to certify that Mr./Ms. _______________ is a bonafide student of the University of the Immaculate Conception, academic year 2013 - 2014.',0,'D');
		$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, '											This further certifies that he/she has observed strictly the school policies in his/her stay in this institution. And that he/she possesses a good moral character. And that he/she has no failing grades or dropped on any subject in the last two semesters.',0,'D');
		$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, '											Issued this _____ day of __________ (month), 20__ upon request of Mr./Ms. _________________________ for whatever legal purpose it may serve.',0,'D');
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->SetFont('Times','',12);
		$this->pdf->MultiCell(0,5, '____________________________',0,'R');
		$this->pdf->MultiCell(0,5, 'College Department',0,'R');
		$this->pdf->MultiCell(0,5, 'UIC - Davao City',0,'R');
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->Ln();
$this->pdf->SetFont('Times','',12);
		$this->pdf->MultiCell(0,5, '____________________________',0,'R');
		$this->pdf->MultiCell(0,5, 'College Department',0,'R');
		$this->pdf->MultiCell(0,5, 'UIC - Davao City',0,'R');
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, 'Noted by:',0,'R');
		$this->pdf->Ln();
		$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, '____________________________',0,'R');
		$this->pdf->MultiCell(0,5, 'Associate Dean',0,'R');
		$this->pdf->MultiCell(0,5, 'UIC - Davao City',0,'R');
        $this->pdf->Output();
?>