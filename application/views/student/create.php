<div class="col-sm-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home/view_all_student" class="btn btn-xs btn-info" title='Back Select Account To Register Student'><i class="fa fa-reply"></i> </a>
			<h3 class="panel-title fa fa-user col-sm-offset-4"> ADD STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="panel col-md-4 col-sm-offset-4">
				<?php echo form_open('class_record/add_new_student/'.$student_name[0]['account_id'],'class="form-horizontal"');?>
					
					<?php
					 	$lname = $student_name[0]['last_name'];
					 	$fname = $student_name[0]['first_name'];
					 	$mname = $student_name[0]['middle_name'];

					 	echo "NAME ";
						echo "<h4>".$lname.", ".$fname." ".$mname."</h4>";
					?>
					<?php
			
						for($x=0;$x<count($dropdown_course);$x++)
						{
							$options [$dropdown_course[$x]['course_id']] = $dropdown_course[$x]['acronym'];
						}
						$data_input_yr_lvl=array(
							'name'=>'yr_lvl',
							'class'=>'num_only form-control',
							'placeholder'=>'YEAR LEVEL',
							'required'=>'',
							'type'=>'number'
							);
						$data_submit=array(
							'name'=>'add_student',
							'class'=>'col-sm-4 pull-right btn btn-primary',
							'value'=>'SAVE'
							);
						echo "YEAR-LEVEL";
						echo form_input($data_input_yr_lvl);
						echo "COURSE";
						echo form_dropdown('course',$options,'','class="form-control"');
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