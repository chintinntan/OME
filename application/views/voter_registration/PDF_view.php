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
		$acct_username = "Username: ".$result['acct_username'];

                $acct_password = "Password: ".$result['acct_password'];
		$acct_name = "Name: ".$result['acct_fname']." ".$result['acct_mname']." ".$result['acct_lname'];
		$course = "Course: ".$result['course_name'];
                $dateTime_printed = "Date and Time Printed: ".date("Y-m-d H:i:s", time()-14400);
		
                $this->pdf->AddPage('L',array(107.95,139.7));
                $this->pdf->SetFont('Times','',14);
		$this->pdf->MultiCell(0,5, 'University of Immaculate Conception',0,'C');
		$this->pdf->MultiCell(0,5, 'Commission on Elections and Appointments',0,'C');$this->pdf->Ln();
		$this->pdf->SetFont('Times','',12);
		$this->pdf->MultiCell(0,5, 'Access Details',0,'C');$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, $acct_name,0,'D');
		$this->pdf->MultiCell(0,5, $course,0,'D');$this->pdf->Ln();
                $this->pdf->MultiCell(0,5, $acct_username,0,'D');
                $this->pdf->MultiCell(0,5, $acct_password,0,'D');
		$this->pdf->Ln();$this->pdf->Ln();
		$this->pdf->MultiCell(0,5, $dateTime_printed,0,'D');
                $this->pdf->Output();
	    

	    $acct_password = "Password: ".utf8_decode($result['acct_password']);
		$acct_name = strtoupper(utf8_decode($result['acct_fname']." ".
													 $result['acct_mName']." ".
													 $result['acct_lName']));
		$course = $result['course_name'];
		$dateTime_printed = "***Date_Time_Printed ".unix_to_human($timestamp);	
		$message_1 = "This document is CONFIDENTIAL.";
		$message_2 = "Present this to the UIC COMELEC during the signing of clearance.";
	    $paper_size = array(107.95,139.7); 	// Unit used is Millimeter

	    $this->pdf->AddPage('P',$paper_size);
	    $this->pdf->Ln(2);
	    $this->pdf->SetFont('Times','',11);
		$this->pdf->MultiCell(0,5, 'University of the Immaculate Conception',0,'C');
		$this->pdf->SetFont('Times','B',11);
		$this->pdf->MultiCell(0,5, 'Commission on Elections and Appointments',0,'C');
		$this->pdf->SetFont('Times','',11);
		$this->pdf->MultiCell(0,5, 'Student Supreme Government',0,'C');
		$this->pdf->Ln();
		$this->pdf->SetFont('Times','U',11);
		$this->pdf->MultiCell(0,5, 'VOTER PROFILE',0,'L');
		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->MultiCell(0,5, $acct_name,0,'L');
		$this->pdf->SetFont('Courier','',9);
		$this->pdf->MultiCell(0,4, $course,0,'D');
		$this->pdf->Ln(10);
		$this->pdf->SetFont('Times','U',11);
		$this->pdf->MultiCell(0,5, 'ACCESS DETAILS',0,'L');
	    $this->pdf->SetFont('Courier','',10);
	    $this->pdf->MultiCell(0,5, $acct_username,0,'L');
	    $this->pdf->MultiCell(0,5, $acct_password,0,'L');
		$this->pdf->Ln(10);
		$this->pdf->SetFont('Courier','B',10);
		$this->pdf->MultiCell(0,5,"Reminders",'','L');
		$this->pdf->SetFont('Courier','',10);
		$this->pdf->MultiCell(0,5,$message_1,1,'L');
		$this->pdf->Ln(1);
		$this->pdf->MultiCell(0,5,$message_2,1,'L');
		$this->pdf->SetFont('Courier','',8);
		$this->pdf->Text(5,5, $dateTime_printed);
	    $this->pdf->Output();
	// }
?>