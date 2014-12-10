<div class="col-md-9">
	<div class="panel panel-default">

		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">ASSIGN SECTION and COURSE</h3>
		</div>

		<div class="panel-body">
		<br>
			<div class="panel col-sm-4 col-sm-offset-4">
				<div class="panel-body">
					<?php echo form_open('class_record/add_new_class/'.$teacher_acct_id,'class="form-horizontal"');?>
						<?php 
							for($x=0;$x<count($section);$x++)
								{
								$option_section_value [$section[$x]['section_id']] = $section[$x]['label'];
								}
							for($x=0;$x<count($course);$x++)
								{
								$options_course_value [$course[$x]['course_id']] = $course[$x]['acronym'];
								}
							$option_section=array(
								'name'=>'section',
								'class'=>'form-control'
							);


							$option_course=array(
								'name'=>'course',
								'class'=>'form-control'
							);
							

							$submit_assign=array(
								'name'=>'submit',
								'value'=>'SUBMIT',
								'class'=>'btn btn-primary pull-right'
							);
							echo form_dropdown('section',$option_section_value,'','class="form-control"'); 
							echo "<br>";
							echo form_dropdown('course',$options_course_value,'','class="form-control"');
							echo form_submit($submit_assign);
						?>

					<?php echo form_close();?>
				</div>
			</div>
		</div>

	</div>
</div>