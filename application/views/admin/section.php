<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>section/create_section" class="btn btn-sm btn-info" title='Create Section'><i class="fa fa-pencil-square"></i> </a>
			
			<h3 class="panel-title fa fa-book col-sm-offset-5"> SECTION</h3>
		</div>

		<div class="panel-body">
		<div class="col-md-6">
			<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th>Section</th>
								<th></th>
							</tr>
						</thead>
						<?php
							for($x=0;$x<count($section_data);$x++)
							{
								$section_id = $section_data[$x]['section_id'];
								$section 	= $section_data[$x]['label'];
							?>
						<tbody>
							<tr>
								<td></td>
								<td><?php echo $section ?></td>
								<td><?php echo "<a href=".base_url()."section/update_section_page/".$section_id." class='fa fa-pencil-square-o btn btn-sm btn-danger' title='Update Section'> ";?></a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
		</div>
				
		</div>

	</div>
</div>