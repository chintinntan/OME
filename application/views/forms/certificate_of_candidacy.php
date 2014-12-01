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
	        $this->pdf->SetFont('Times','',12);
			$this->pdf->MultiCell(0,5, 'University of Immaculate Conception',0,'C');
			$this->pdf->SetFont('Times','',14);
			$this->pdf->MultiCell(0,5, 'STUDENT SUPREME GOVERNMENT',0,'C');
			$this->pdf->MultiCell(0,5, 'COMMISSION ON ELECTIONS AND APPOINTMENTS',0,'C');
			$this->pdf->SetFont('Times','',12);
			$this->pdf->MultiCell(0,5, 'Davao City, Philippines 8000',0,'C');$this->pdf->Ln();
			$this->pdf->Ln();
			$this->pdf->Ln();
			$this->pdf->SetFont('Times','',18);
			$this->pdf->MultiCell(0,5, 'CERTIFICATE OF CANDIDACY',0,'C');
			$this->pdf->Ln();
			$this->pdf->Ln();
			$this->pdf->SetFont('Times','',12);

			$body_text = "I hereby announce my candidacy for _______________(position) of the _________________________ (program/organization), of the University of the Immaculate Conception on the 2014 SSG and Program Elections and hereby state the following:";

			$this->pdf->MultiCell(0,5, $body_text,0,'C');
			$this->pdf->Ln();
			$this->pdf->Ln();
	        $this->pdf->MultiCell(0,5, '__________________________________',0,'C');
	        $this->pdf->MultiCell(0,5, 'Party',0,'C');

	        $body_text2 = "
	1.   Full Name: _________________, __________________ ___
						Family Name														First Name				M.I.
	
	2.   Course and Year: __________________

	3.   Address: ______________________________________________

	     Contact No.: __________________

	4.   Date of Birth: _________________

	5.   Possessing the following qualifications:

a)	A Filipino citizen
b)	A resident of at least four(4) semesters; two(2) years of whichimmediately prior to the election.
c)	Not holding a major office in whichever school organization.(President, Vice-
President, Secretary, Treasurer)
d)	Passed all subjects without any mark of dropped on any subject in two preceding semesters before filing of candidature duly certified by the dean. 
e)	Possesses qualities of a high-quality leader, with good moral character and recommended by the associate dean.
f)	Not a graduating student in the first semester of his/her first term of office.
";

	        $this->pdf->MultiCell(0,5, $body_text2,0,'C');
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