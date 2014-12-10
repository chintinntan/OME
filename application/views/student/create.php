<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">ADD STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="panel col-md-6 col-sm-offset-2">
				<?php echo form_open('class_record/add_new_student/'.$student_name[0]['account_id'],'class="form-horizontal"');?>
					<label class="control-label">Name:</label>
					<?php
					 	$lname = $student_name[0]['last_name'];
					 	$fname = $student_name[0]['first_name'];
					 	$mname = $student_name[0]['middle_name'];

					 	echo "&nbsp".$lname.", ".$fname." ".$mname;
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
							'placeholder'=>'YEAR LEVEL',
							'required'=>''
							);
						$data_submit=array(
							'name'=>'add_student',
							'class'=>'col-sm-4 pull-right btn btn-primary',
							'value'=>'SAVE'
							);
						echo form_input($data_input_yr_lvl);
						echo form_dropdown('course',$options,'','class="form-control"');
						echo form_submit($data_submit);
				?>
			</div>			
		</div>
		</div>
	</div>
</div>