<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b><?php echo 'username account data from database';?></b></h3>
		</div>
		
		<div class="panel-body">
			<br>
			<label class="control-label col-sm-offset-1">ID NUMBER: </label><?php echo "&nbsp".$id_num;?>
			<label class="control-label col-sm-offset-1">ACCOUNT TYPE: </label><?php echo "&nbsp".$acct_type;?>

			<br>
			<label class="control-label col-sm-offset-1">USERNAME:</label><?php echo "&nbsp".$username;?>
			<br>
			<label class="control-label col-sm-offset-1">NAME:</label><?php echo "&nbsp".$acct_lname.", ".$acct_fname." ".$acct_mname;?>
		</div>
	</div>
</div>