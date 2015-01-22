<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url(); ?>teacher_home/generate_exam_page" class="col-sm-1">BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">QUESTION OPTION</h3>
		</div>
		<div class="panel-body">
			<?php 
				$subj_id = $exam_details[0]['subject_id'];
				echo form_open("teacher_home/all_generate_questionnaire_page/".$exam_id."/".$subj_id."",'form-horizontal');
			?>
			<div class="col-md-6 col-md-offset-3">
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>EXAM TITLE</th>
								<th>
									<?php
										echo $exam_details[0]['title_exam'];
									?>
								</th>
							</tr>
							<tr>
								<th>SUBJECT NAME</th>
								<th>
									<?php 
										echo $exam_details[0]['subject_label'];
									?>
								</th>
							</tr>
							<tr>
								<th>PERIOD</th>
								<th>
									<?php
										echo $exam_details[0]['label'];
									?>
								</th>
							</tr>
							<tr>
								<th>DATE</th>
								<th>
									<?php 
										echo $exam_details[0]['exam_date'];
									?>
								</th>
							</tr>
							<tr>
								<th>ITEM QTY</th>
								<th>
									<?php 
										$data_input_qty=array(
											'name'=>'item_qty',
											'class'=>'num_only form-control',
											'placeholder'=>'ITEM QTY',
											'required'=>''
										);
										echo form_input($data_input_qty);
									?>
								</th>
							</tr>

							<tr>
								<th></th>
								<th>
									<input type="submit" class="btn btn-sm btn-default pull-right" value="SUBMIT">
								</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>