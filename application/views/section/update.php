<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>section" class="btn btn-sm btn-info" title="Back to Subject List"><i class="fa fa-reply"></i></a>
			<h3 class="panel-title fa fa-book col-sm-offset-4"> UPDATE SECTION</h3>
		</div>

		<div class="panel-body">
			<?php echo form_open('section/update_section/'.$sec_update_data[0]['section_id'],'class="form-horizontal"');?>
			<br>
				<div class="form-group">
				<label class="col-sm-4 control-label">Section Acronym</label>
					<div class="col-sm-3">
						<?php
							for($x=0;$x<count($sec_update_data);$x++)
							{
								$section_name = $sec_update_data[0]['label'];
							}
						?>
						<?php echo form_input('section_acronym',"".$section_name."",'class="form-control"');?>	
					</div>
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn col-sm-offset-6 btn-default">
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>