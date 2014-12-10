<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home/view_all_student" class="col-sm-1">CREATE</a>
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
						for($x=0;$x<count($student_list);$x++)
						{
							$stud_id = $student_list[$x]['student_id'];
							$lname = $student_list[$x]['last_name'];
							$fname = $student_list[$x]['first_name'];
							$mname = $student_list[$x]['middle_name'];
						}
					?>
					<tbody>
						<tr>
							<td><?php echo $lname.", ".$fname." ".$mname;?></td>
							<td><?php echo "<a href=".base_url()."student_home/update_student_page/".$stud_id.">Update";?></a></td>
						</tr>
					</tbody>
				
				</table>	
			</div>
		</div>
	</div>
</div>