<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>student_home/view_all_student" class="col-sm-1">CREATE</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">STUDENT</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
		 		<table class="table">
					<thead>
						<tr>
							<td>Name</td>
							<td>Option</td>
						</tr>
					</thead>
					
					<tbody>
						<tr>
							<td><?php echo "list of all student";?></td>
							<td><a href="<?php echo base_url();?>student_home/update_student">Update</a></td>
						</tr>
					</tbody>
				
				</table>	
			</div>
		</div>
	</div>
</div>