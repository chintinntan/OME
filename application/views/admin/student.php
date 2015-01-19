<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home/view_all_student" class="col-sm-2"><i class="fa fa-plus-square"></i> CREATE</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-user"> STUDENT</h3>
		</div>

		<div class="panel-body">
			
				<div class="table table-responsive">
		 		<table class="table">
					<thead>
						<tr>
							<th>NAME</th>
							<th></th>
							<th>OPTION</th>
						</tr>
					</thead>
					<?php
						for($x=0;$x<count($student_list);$x++)
						{
							$stud_id = $student_list[$x]['student_id'];
							$lname 		  = $student_list[$x]['last_name'];
							$fname 		  = $student_list[$x]['first_name'];
							$mname 		  = $student_list[$x]['middle_name'];
							$course       = $student_list[$x]['acronym'];
							$year_level	=$student_list[$x]['year_level'];
					?>
					<tbody>
						<tr>
							<td><?php echo $lname.", ".$fname." ".$mname;?></td>
							<td><?php echo $course."-".$year_level;?></td>
							<td><?php echo "<a href=".base_url()."student_home/update_student_page/".$stud_id." class='fa fa-pencil btn btn-xs btn-primary'> UPDATE";?></a></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>	
				</div>			
			
		</div>
	</div>
</div>
