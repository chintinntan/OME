<div class="col-md-5 col-md-offset-2">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-sm-5"></span>
			<h3 class="panel-title fa fa-users"> GET SUBJECT AND SECTION</h3>
		</div>

		<div class="panel-body">
			<?php echo form_open('teacher_home/search_class_student','form-horizontal');?>
			<div class="table table-reponsive">
				<table class="table">
					<tr>
						<th><h4>SUBJECT</h4></th>
						<td>
							<?php
								for($x=0;$x<count($dropdown_subject);$x++)
								{		
									$subject_option [$dropdown_subject[$x]['subject_id']] = $dropdown_subject[$x]['subject_label'];
								}
								echo form_dropdown('subject_selected',$subject_option,'','class="form-control"'); 
							?>
						</td>
					</tr>
								
					<tr>
						<th><h4>SECTION</h4></th>
						<td>
							<?php
								for($x=0;$x<count($dropdown_section);$x++)
								{		
									$section_option [$dropdown_section[$x]['section_id']] = $dropdown_section[$x]['label'];
								}
								echo form_dropdown('section_selected',$section_option,'','class="form-control"');
							?>
						</td>
					</tr>

					<tr>
						<td></td>
						<td><input type="submit" class='btn btn-default pull-right' value="SUBMIT"></td>
					</tr>
				</table>
			</div>
			<?php echo form_close();?>

		</div>
	</div>
</div>