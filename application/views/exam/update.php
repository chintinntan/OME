<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url(); ?>teacher_home/generate_exam_page" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title"> UPDATE GENERATE EXAMS</h3>
		</div>

		<div class="panel-body">
			<?php
				$exam_id = $exam_title_date[0]['exam_schedule_id'];
				echo form_open("teacher_home/update_exam/".$exam_id."",'class="form-horizontal"');
			?>
				<div class="col-md-5 col-md-offset-3">
					<div class="table table-responsive">
						<table class="table">
							<tr>
								<th>TITLE</th>
								<th>
									<?php
										$title = $exam_title_date[0]['title_exam'];
										$data_input_title=array(
											'name'=>'exam_title',
											'class'=>'form-control',
											'placeholder'=>'EXAM TITLE',
											'value' => $title,
											'required'=>''
										);
										echo form_input($data_input_title);
									?>
								</th>
							</tr>
							<tr>
								<th>SUBJECT</th>
								<th>
									<?php
										for($x=0;$x<count($dropdown_subjects);$x++)
										{		
											$subject_option [$dropdown_subjects[$x]['subject_id']] = $dropdown_subjects[$x]['subject_label'];
										}
										echo form_dropdown('selected_subjects',$subject_option,'','class="form-control"');
									?>
								</th>
							</tr>
							<tr>
								<th>PERIOD</th>
								<th>
									<?php
										for($x=0;$x<count($dropdown_period);$x++)
										{		
											$grading_option [$dropdown_period[$x]['grading_period_id']] = $dropdown_period[$x]['label'];
										}
										echo form_dropdown('selected_grading_period',$grading_option,'','class="form-control"');
									?>
								</th>
							</tr>
							<tr>
								<th>DATE</th>
								<th>
									
									<?php
										$exam_date = $exam_title_date[0]['exam_date'];
										$data_input_date=array(
											'name'=>'date',
											'class'=>'form-control',
											'required'=>'',
											'value' => $exam_date,
											'placeholder'=>'DATE OF EXAM'
										);
										echo form_input($data_input_date);
									?>
									
								</th>
							</tr>
							<tr>
								<th>PASSWORD</th>
								<th>
									<?php 
										$data_password=array(
											'name'=>'password',
											'class'=>'form-control',
											'required'=>'',
											'placeholder'=>'PASSWORD'
										);
										echo form_password($data_password);
									?>
								</th>
							</tr>
							<tr>
								<th></th>
								<th>
									<?php 
										$data_con_pass=array(
											'name'=>'con_password',
											'class'=>'form-control',
											'required'=>'',
											'placeholder'=>'CONFIRM PASSWORD'
										);
										echo form_password($data_con_pass);
									?>
								</th>
							</tr>
							<tr>
								<th></th>
								<th><input type="submit" class="btn btn-default pull-right" value="SUBMIT"></th>
							</tr>
						</table>
					</div>
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>