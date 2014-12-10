<div class="col-md-9">
	<div class="panel panel-default">

		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="col-sm-2"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-clipboard"> CREATE CLASS RECORD</h3>
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
								$option_course_value [$course[$x]['course_id']] = $course[$x]['acronym'];
								}
							for($x=0;$x<count($subject);$x++)
								{
								$option_subject_value [$subject[$x]['subject_id']] = $subject[$x]['acronym'];
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

							$data_semester=array(
								'1ST SEMESTER'=>'1ST SEMESTER',
								'2ND SEMESTER'=>'2ND SEMESTER',
								'SUMMER'=>'SUMMER'
								);
							$data_input_school_year=array(
								'name'=>'school_year',
								'class'=>'form-control',
								'placeholder'=>'SCHOOL YEAR',
								'required'=>''
								);
							echo "COURSE".form_dropdown('course',$option_course_value,'','class="form-control"');
							echo "<br>";
							echo "SECTION".form_dropdown('section',$option_section_value,'','class="form-control"'); 
							echo "<br>";
							echo "SUBJECT".form_dropdown('subject',$option_subject_value,'','class="form-control"');
							echo "<br>";
							echo "SEMESTER".form_dropdown('semester',$data_semester,'','class="form-control"');
							echo "<br>";
							echo "SCHOOL YEAR".form_input($data_input_school_year);
							echo "<br>";
							echo form_submit($submit_assign);
						?>

					<?php echo form_close();?>
				</div>
			</div>
		</div>

	</div>
</div>