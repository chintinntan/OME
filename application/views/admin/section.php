<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>section/create_section" class="col-sm-2">ADD SECTION</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title">SECTION</h3>
		</div>

		<div class="panel-body">
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Section</th>
							<th>Option</th>
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
							<td><?php echo $section ?></td>
							<td><?php echo "<a href=".base_url()."section/update_section_page/".$section_id.">Update";?></a></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>