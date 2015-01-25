<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="#" class="col-sm-1">BACK</a>
			<span class="col-md-4"></span>
			<h3 class="panel-title">CHECK EXAM PASSWORD</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open("student_home/take_exam/".$exam_sched_id."/".$stud_id."",'form-horizontal');?>
			<div class="col-sm-4 col-sm-offset-4">
				<div class="table table-responsive">
					<table class="table">
						<tr>
							<th>Exam Title: </th>
							<th><?php echo $exam_title ?></th>
						</tr>
						<tr>
							<th>Password: </th>
							<th>
								<?php
									$data=array(
										'name'=>'password',
										'class'=>'form-control',
										'required'=>'',
										'placeholder'=>'PASSWORD'
									);
									echo form_password($data);
								?>
							</th>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="SUBMIT" class="btn btn-sm btn-success pull-right"></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>