<div class="col-md-9">
	<div class="panel panel-default">

		<div class="panel-heading">
			<a href="<?php echo base_url();?>admin_home/teacher_assign" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">ASSIGN SECTION and COURSE</h3>
		</div>

		<div class="panel-body">
		<br>
			<div class="panel col-sm-4 col-sm-offset-4">
				<div class="panel-body">
					<?php echo form_open('admin_home/add_student','class="form-horizontal"');?>
					<a href="#">Add Section</a>
						<?php 
							for($x=0;$x<count($page_view_data);$x++)
								{
								$option_section_value [$page_view_data[$x]['account_type_id']] = $page_view_data[$x]['label'];
								}
							for($x=0;$x<count($page_view_data);$x++)
								{
								$options_course_value [$page_view_data[$x]['account_type_id']] = $page_view_data[$x]['label'];
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
								'value'=>'SAVE',
								'class'=>'btn btn-primary pull-right'
							);
							echo form_dropdown($option_section,$option_section_value); 
							echo "<br>";
							echo form_dropdown($option_course,$options_course_value);
							echo form_submit($submit_assign);
						?>

					<?php echo form_close();?>
				</div>
			</div>
		</div>

	</div>
</div>