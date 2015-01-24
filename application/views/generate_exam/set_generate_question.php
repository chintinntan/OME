<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url(); ?>teacher_home/generate_exam_page" class="btn btn-xs btn-info fa fa-reply" title='Back'></a>
			
			<h3 class="panel-title fa fa-file-o col-sm-offset-5"> QUESTION OPTION</h3>
		</div>
		<div class="panel-body">
			<?php 
				$subj_id = $exam_details[0]['subject_id'];
				$period_id = $exam_details[0]['grading_period_id'];
				echo form_open("teacher_home/all_generate_questionnaire_page/".$exam_id."/".$subj_id."/".$period_id."",'form-horizontal');
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
								<th>TOTAL ITEMS</th>
								<th>
									<?php 
										$data_input_total_qty=array(
											'name'=>'item_total_qty',
											'class'=>'num_only form-control',
											'placeholder'=>'TOTAL QTY ITEM',
											'required'=>''
											
										);
										echo form_input($data_input_total_qty);
									?>
								</th>
							</tr>
							<tr>
								<th>ITEMS FOR HARD</th>
								<th>
									<?php 
										$data_input_qty_hard=array(
											'name'=>'item_qty_hard',
											'class'=>'num_only form-control',
											'placeholder'=>'ITEM QTY HARD'
											
										);
										echo form_input($data_input_qty_hard);
									?>
								</th>
							</tr>
							<tr>
								<th>ITEMS FOR EASY</th>
								<th>
									<?php 
										$data_input_qty_easy=array(
											'name'=>'item_qty_easy',
											'class'=>'num_only form-control',
											'placeholder'=>'ITEM QTY EASY'
										);
										echo form_input($data_input_qty_easy);
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