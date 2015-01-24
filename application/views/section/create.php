<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>section" class="btn btn-xs btn-info" title='Back to Section List'><i class="fa fa-reply"></i> </a>
		
			<h3 class="panel-title fa fa-book col-sm-offset-4"> CREATE SECTION</h3>
		</div>

		<div class="panel-body">
			<?php echo form_open('section/add_new_section','class="form-horizontal"');?>
			<br>
				<div class="form-group">
				<label class="col-sm-4 control-label">Section Acronym</label>
					<div class="col-sm-3">
						<?php echo form_input('section_acronym','','class="form-control"');?>	
					</div>
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn col-sm-offset-6">
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>