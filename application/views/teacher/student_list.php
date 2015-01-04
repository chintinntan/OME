<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="col-sm-5"></span>
			<h3 class="panel-title fa fa-users"> Student List</h3>
		</div>

		<div class="panel-body">

			<div class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label">SUBJECT</label>			
					<div class="col-sm-4">
						<?php
							$data=array('subject'=>'sort by subject of the list of student');
					
							echo form_dropdown('sort_section',$data,'','class="form-control"'); 
						?>
					</div>
					<label class="col-sm-1 control-label">SECTION</label>			
					<div class="col-sm-2">
						<?php
							$data=array('section'=>'sort by section of the list of student');
					
							echo form_dropdown('sort_section',$data,'','class="form-control"'); 
						?>
					</div>
				</div>
			</div>
			
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>NAME</th>
							<th>COURSE</th>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>Name of student</td>
							<td>course & section</td>
							
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>