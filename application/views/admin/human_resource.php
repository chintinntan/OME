<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url(); ?>admin_home/create_human_resource" class="btn btn-info btn-xs" title='Create Account'><i class="fa fa-pencil-square"></i></a>
			<h3 class="panel-title fa fa-users col-sm-offset-5"> HUMAN RESOURCE</h3>
		</div>
	
		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Account type</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>

					<?php
						 for($x=0;$x<count($acct_details);$x++)
	           			 {
			                $acct_id 	= $acct_details[$x]['account_id'];
			                $acct_lName = $acct_details[$x]['last_name'];
			                $acct_fName = $acct_details[$x]['first_name'];
			                $acct_mName = $acct_details[$x]['middle_name'];
			                $acct_type  = $acct_details[$x]['acct_type'];
			                $acct_status= $acct_details[$x]['acct_status'];
            		?>

							<tbody>
								<tr>
									<td><?php echo $acct_lName.", ".$acct_fName." ".$acct_mName;?></td>
									<td><?php echo $acct_type;?></td>
									<td><?php if($acct_status==1)
											{
												echo "ACTIVE";
												}
												else
												{
													echo "INACTIVE";
													}
										?></td>
									<td><?php echo "<a href=".base_url()."account/update_account_page/".$acct_id." class='fa fa-pencil-square-o btn btn-xs btn-danger' title='Update Account'>";?></a></td>
								</tr>
							</tbody>
					<?php } ?>
				</table>
			</div>
		</div>

	</div>
</div>
<!--note pagination-->