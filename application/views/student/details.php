<div class="col-sm-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."class_record/view_all_student/".$this->uri->segment(3, 0)."/".$this->uri->segment(4, 0)."/".$this->uri->segment(5, 0)." class='col-md-1'> BACK";?></a>
			<span class="col-md-4"></span>
			<h3 class="panel-title"> Student Details</h3>
		</div>

		<div class="panel-body">
			
			<div class="col-md-5 col-md-offset-3">
				<div class="table table-reponsive">
					<table class="table">
						<tr>
							<td>Name:</td>
							<td><?php echo $student_details[0]['first_name']." ".$student_details[0]['middle_name']." ".$student_details[0]['last_name']?></td>
						</tr>
						<tr>
							<td>Course and Section:</td>
							<td><?php echo $student_details[0]['acronym']."-".$student_details[0]['year_level']?></td>
						</tr>
						<tr>
							<td></td>
							<td><?php echo "<a href=".base_url()."class_record/register_student/".$this->uri->segment(3,0)."/".$this->uri->segment(4,0)."/".$class_record_id."/".$stud_id."> SUBMIT";?></a></td>
						</tr>
					</table>
				</div>	
			</div>
			
		</div>
	</div>
</div>