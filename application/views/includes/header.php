<!DOCTYPE html>
    
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>University of the Immaculate Conception - Commission on Elections and Appointments</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/layout2.css" type="text/css" media="screen" charset="utf-8">
    
    <script type="text/javascript">					
  		var days = <?php echo $election_countdown['day']; ?>	
		var hours = <?php echo $election_countdown['hour']; ?>	
		var minutes = <?php echo $election_countdown['minute']; ?>	
		var seconds = <?php echo $election_countdown['second']; ?>

		

		function display()
		{
			
			if(seconds<=0)
			{
				seconds = 60
				minutes -= 1
			}
			if(minutes<=-1)
			{
				minutes = 0
				hours -= 1
			}
			else
			{
				seconds -=1
				// if(minutes==0 && seconds==0)
				// {
				// 	document.getElementById("counter").innerHTML = '<meta http-equiv="refresh" content="0;url=logout.php">'
				// }
				if(seconds<10)
				{
					document.getElementById("counter").innerHTML = days+" Days "+hours+":"+minutes+":0"+seconds
				}
				else
				{
					document.getElementById("counter").innerHTML = days+" Days "+hours+":"+minutes+":"+seconds
				}	
				setTimeout("display()",1000) 
			}
		}		
	</script>
</head>
<body>
	<?php
		if($logged_in)
		{
	?>
<div id="header">
	<div id="banner">
		<div id="banner_content">ELECTION DASHBOARD</div>
		<div id="banner_description">Commission on Elections and Appointments, University of the Immaculate Conception</div>
	</div>		
<div id="login_form_container">  
	<?php
		$fname = $this->session->userdata('acct_fname');
		$lname = $this->session->userdata('acct_lname');
		echo $fname." ".$lname;
		echo " ".'[<a href="'.base_url().'index.php/logout">Logout</a>]';
	?>
	</div>
</div>
	<?php
		}
	?>
    