<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home" class="col-sm-2"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-user"> UPDATE STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="panel col-md-6 col-sm-offset-3">
				<?php echo form_open('class_record/update_stud_data/'.$stud_update_data[0]['student_id'],'class="form-horizontal"');?>
					<label class="control-label">Name:</label>
					<?php 
						for($x=0;$x<count($stud_update_data);$x++)
						{
							$lname = $stud_update_data[$x]['last_name'];
							$fname = $stud_update_data[$x]['first_name'];
							$mname = $stud_update_data[$x]['middle_name'];
							$yr_lvl = $stud_update_data[$x]['year_level'];
						}
						echo $lname.", ".$fname." ".$mname;
					?>
					<br>
					<label class="control-label">Year-Level</label>
					<?php
						for($x=0;$x<count($dropdown_course);$x++)
						{
							$options [$dropdown_course[$x]['course_id']] = $dropdown_course[$x]['acronym'];
						}
						$data_input_yr_lvl=array(
							'name'=>'yr_lvl',
							'class'=>'form-control',
							'placeholder'=>$yr_lvl,
							'required'=>''
							);
						$data_submit=array(
							'name'=>'add_student',
							'class'=>'col-sm-4 pull-right btn btn-primary',
							'value'=>'SAVE'
							);
						echo form_input($data_input_yr_lvl);
						echo "<br>";
						echo form_dropdown('course',$options,'','class="form-control"');
						echo form_submit($data_submit);
				?>
			</div>			
		</div>
		</div>
	</div>
</div>