<div class="col-sm-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home" class="btn btn-xs btn-info" title='Back to All Student'><i class="fa fa-reply"></i></a>
			
			<h3 class="panel-title fa fa-location-arrow col-sm-offset-4"> SELECT ACCOUNT TO REGISTER STUDENT</h3>
		</div>

		<div class="panel-body">
			
				<div class="table table-responsive">
		 		<table class="table">
					<thead>
						<tr>
							<th>NAME</th>
							<th>OPTION</th>
						</tr>
					</thead>
					<?php
						for($x=0;$x<count($student_details);$x++)
						{
							$stud_acct_id = $student_details[$x]['account_id'];
							$lname 		  = $student_details[$x]['last_name'];
							$fname 		  = $student_details[$x]['first_name'];
							$mname 		  = $student_details[$x]['middle_name'];
					?>
					<tbody>
						<tr>
							<td><?php echo $lname.", ".$fname." ".$mname;?></td>
							<td><?php echo "<a href=".base_url()."student_home/select_student/".$stud_acct_id." class='fa fa-location-arrow btn btn-xs btn-danger' title='Select an Account'>";?></a></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>	
				</div>			
			
		</div>
	</div>
</div>