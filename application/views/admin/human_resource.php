<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url(); ?>admin_home/create_human_resource" class="col-sm-1"> CREATE</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title">HUMAN RESOURCE</h3>
		</div>
	
		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Account type</th>
							<th>Option</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td><?php echo "Full Name";?></td>
							<td><?php echo "Account type";?></td>
							<td><a href="<?php echo base_url(); ?>admin_home/update_human_resource">Update</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
<!--note pagination-->