<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-sm-5"></span>
			<h3 class="panel-title fa fa-book"> ALL SUBJECTS</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>SUBJECT</th>
							<th>COURSE</th>
							<th></th>
						</tr>	
					</thead>

					<tbody>
						<?php
							$this->load->helper('inflector');

							for($x=0;$x<count($teacher_subjects);$x++)
							{
								$subj_id = $teacher_subjects[$x]['subject_id'];
								$subj_name = $teacher_subjects[$x]['subject_label'];
								$course = $teacher_subjects[$x]['course_label'];
						?>
						<tr>
							<td><?php echo $subj_name; ?></td>
							<td><?php echo $course; ?></td>
							<td>
								<?php echo "<a href=".base_url()."question_bank/questionnaire/".underscore($subj_name)."/".$subj_id." title = 'Select Subject' class='btn btn-sm btn-danger fa fa-location-arrow'>";?></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>