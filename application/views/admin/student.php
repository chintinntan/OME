<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home/add_student" class="col-sm-1">CREATE</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
		 		<table class="table">
					<thead>
						<tr>
							<td>Name</td>
							<td>Option</td>
						</tr>
					</thead>
					<?php
						for($x=0;$x<count($teacher_list);$x++)
						{
							$teacher_acct_id = $teacher_list[$x]['account_id'];
							$lname 	 = $teacher_list[$x]['last_name'];
							$fname 	 = $teacher_list[$x]['first_name'];
							$mname 	 = $teacher_list[$x]['middle_name'];
					?>
					<tbody>
						<tr>
							<td><?php echo "<b>".$lname.", ".$fname." ".$mname."</b>"?></td>
							<td><?php echo "<a href=".base_url()."teacher_home/create_teacher_assign/".$teacher_acct_id.">Assign";?></a>
								<a href="#">View Assigned Class</a></td>
						</tr>
					</tbody>
				<?php 	} ?>
				</table>	
			</div>
		</div>
	</div>
</div>