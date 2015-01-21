<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url(); ?>teacher_home/generate_exam_page" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title"> CREATE GENERATE EXAMS</h3>
		</div>

		<div class="panel-body">
			<?php echo form_open('','class="form-horizontal"');?>
				<div class="col-md-5 col-md-offset-3">
					<div class="table table-responsive">
						<table class="table">
							<tr>
								<th>TITLE</th>
								<th>
									<?php
										$data_input_title=array(
											'name'=>'exam_title',
											'class'=>'form-control',
											'placeholder'=>'EXAM TITLE',
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
										$data_subject=array(
											'option'=>'subjects'
										); 
										echo form_dropdown('subject',$data_subject,'','class="form-control"');
									?>
								</th>
							</tr>
							<tr>
								<th>PERIOD</th>
								<th>
									<?php
										$data_period=array(
											'option'=>'period'
										); 
										echo form_dropdown('period',$data_period,'','class="form-control"');
									?>
								</th>
							</tr>
							<tr>
								<th>DATE</th>
								<th>
									<tr>
										<?php
											$data_input_date=array(
												'name'=>'date',
												'class'=>'form-control',
												'required'=>'',
												'placeholder'=>'DATE OF EXAM'
											);
											echo form_input($data_input_date);
										?>
									</tr>
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