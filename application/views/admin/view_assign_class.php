<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>teacher_home/teacher_assign" class="col-sm-2"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-list-ul"> ALL CLASS RECORD</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				<br>
				<label class="control-label">TEACHER NAME:</label><?php echo " teacher name";?>
				<table class="table">
					<thead>
						<tr>
							<th>SUBJECT</th>
							<th>COURSE</th>
							<th>SECTION</th>
							<th>OPTION</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>Subject of class</td>
							<td>Course of the class</td>
							<td>Section of the class</td>
							<td><a href="#" class="fa fa-eye btn btn-xs btn-primary"> VIEW CLASS RECORD</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>