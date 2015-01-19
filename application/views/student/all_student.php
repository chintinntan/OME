<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."class_record/view_class_record/".$this->uri->segment(3, 0)."/".$this->uri->segment(4, 0)."/".$this->uri->segment(5, 0)." class='col-md-1'> BACK";?></a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title"> ALL STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>NAME</th>
							<th>COURSE</th>
							<th>OPTION</th>
						</tr>
					</thead>
					<?php
							for($x=0;$x<count($student_list);$x++)
							{
								$stud_id = $student_list[$x]['student_id'];
								$lname = $student_list[$x]['last_name'];
								$fname = $student_list[$x]['first_name'];
								$mname = $student_list[$x]['middle_name'];
								$course= $student_list[$x]['acronym'];
								$year_level= $student_list[$x]['year_level'];
					?>
					<tbody>
						<tr>
							<td><?php echo $lname.", ".$fname." ".$mname ?></td>
								<!--<?php 
									$this->load->library('encrypt');
									$stud_id=urlencode($this->encrypt->encode($stud_id)); 
								?> Encryption Code-->
							<td><?php echo $year_level."-".$course;?></td>
							<td><?php echo "<a href=".base_url()."class_record/check_student_details/".$teacher_id."/".$sec_id."/".$class_record_id."/".$stud_id."> SELECT STUDENT";?></a></td>

							
						</tr>
					</tbody>
						<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>