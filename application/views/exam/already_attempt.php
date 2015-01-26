<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			
			<span class="col-md-5"></span>
			<h3 class="panel-title">CHECK EXAM PASSWORD</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open("student_home/check_exam_result/".$exam_sched_id."",'form-horizontal');?>
			<div class="col-sm-4 col-sm-offset-4">
				<div class="table table-responsive">
					<table class="table">
						<tr>
							<th>Exam Title: </th>
							<th><?php echo $exam_title ?></th>
						</tr>
						<tr>
							<th>MESSAGE </th>
							<th>
								<?php
									
									echo "EXAM ALREADY TAKEN";
								?>
							</th>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			<?php
			$data=array(
					'class'=>'btn btn-success',
					'value'=>'VIEW RESULT'
				);
				echo form_submit($data);
			?> 
		</div>
		<?php echo form_close();?>
	</div>
</div>