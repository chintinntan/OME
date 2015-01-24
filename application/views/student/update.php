<div class="col-sm-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home" class="btn btn-xs btn-info" title='Back To All Student Accounts'><i class="fa fa-reply"></i></a>
			
			<h3 class="panel-title fa fa-user col-sm-offset-4"> UPDATE STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="panel col-md-4 col-sm-offset-4">
				<?php echo form_open('class_record/update_stud_data/'.$stud_update_data[0]['student_id'],'class="form-horizontal"');?>
					
					<?php 
						for($x=0;$x<count($stud_update_data);$x++)
						{
							$lname = $stud_update_data[$x]['last_name'];
							$fname = $stud_update_data[$x]['first_name'];
							$mname = $stud_update_data[$x]['middle_name'];
							$yr_lvl = $stud_update_data[$x]['year_level'];
							$course = $stud_update_data[$x]['course_id'];
						}
						echo "NAME ";
						echo "<h4>".$lname.", ".$fname." ".$mname."</h4>";
					?>
					<br>
					
					<?php
						for($x=0;$x<count($dropdown_course);$x++)
						{
							$options [$dropdown_course[$x]['course_id']] = $dropdown_course[$x]['acronym'];
						}
						$data_input_yr_lvl=array(
							'name'=>'yr_lvl',
							'class'=>'form-control',
							'placeholder'=>'YEAR-LEVEL',
							'value'=>set_value('yr_lvl',$yr_lvl),
							'required'=>''
							);
						$data_submit=array(
							'name'=>'add_student',
							'class'=>'col-sm-4 pull-right btn btn-primary',
							'value'=>'SAVE'
							);
						echo "YEAR-LEVEL";
						echo form_input($data_input_yr_lvl);
						echo "COURSE";
						echo form_dropdown('course',$options,$course,'class="form-control"');
						echo "<div class='table table-responsive'>";
						echo "<table class='table'>";
						echo "<thead>";
						echo "<tr>";
						echo "<td>";
						echo form_submit($data_submit);
						echo "</td>";
						echo "</tr>";
						echo "</thead>";
						echo "</table>";						
						echo "</div>";
					?>
			</div>			
		</div>
		</div>
	</div>
</div>