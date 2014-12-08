<div class="col-md-9">
	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title">ASSIGN SECTION and COURSE</h3>
		</div>

		<div class="panel-body">
		<br>
			<div class="panel col-sm-4 col-sm-offset-4">
				<div class="panel-body">
					<?php echo form_open('link to controller','class="form-horizontal"');?>
					<a href="#">Add Section</a>
						<?php 
							
							$option_section=array(
								'0'=>'--Select SECTION--',
								'name'=>'section',
								'class'=>'form-control'
							);

							$option_course=array(
								'0'=>'--Select COURSE--',
								'name'=>'course',
								'class'=>'form-control'
							);

							$submit_assign=array(
								'name'=>'submit',
								'value'=>'SAVE',
								'class'=>'btn btn-primary pull-right'
							);
							echo form_dropdown($option_section); 
							echo "<br>";
							echo form_dropdown($option_course);
							echo form_submit($submit_assign);
						?>

					<?php echo form_close();?>
				</div>
			</div>
		</div>

	</div>
</div>