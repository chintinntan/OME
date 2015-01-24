<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			
			<span class="col-sm-5"></span>
			<h3 class="panel-title fa fa-archive"> ASSIGN TEACHER</h3>
		</div>

		<div class="panel-body">
			<div class="table">
		 		<table class="table table-hover">
					<thead>
						<tr>
							<th>TEACHER NAME</th>
							<th></th>
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
							<td><?php echo $lname.", ".$fname." ".$mname;?></td>
							<td>
								<?php echo "<a href=".base_url()."teacher_home/create_teacher_assign/".$teacher_acct_id." class='fa fa-pencil-square btn btn-xs btn-danger' title='Create Class Record'>";?></a>
								<?php echo "<a href=".base_url()."class_record/view_class_assign/".$teacher_acct_id." class='fa fa-eye btn btn-xs btn-success' title='View Class Record List'> ";?></a>
							</td>
						</tr>
					</tbody>
				<?php 	} ?>
				</table>	
			</div>
		</div>
	</div>
</div>