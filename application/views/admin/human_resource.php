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

					<?php
						 for($x=0;$x<count($acct_details);$x++)
	           			 {
			                $acct_id 	= $acct_details[$x]['account_id'];
			                $acct_lName = $acct_details[$x]['last_name'];
			                $acct_fName = $acct_details[$x]['first_name'];
			                $acct_mName = $acct_details[$x]['middle_name'];
			                $acct_type  = $acct_details[$x]['acct_type'];
            		?>

							<tbody>
								<tr>
									<td><?php echo "<b>".$acct_lName.", ".$acct_fName." ".$acct_mName;?></td>
									<td><?php echo $acct_type;?></td>
									<td><?php echo "<a href=account/update_account/".$acct_id.">Update"; ?></a></td>
								</tr>
							</tbody>
					<?php } ?>
				</table>
			</div>
		</div>

	</div>
</div>
<!--note pagination-->