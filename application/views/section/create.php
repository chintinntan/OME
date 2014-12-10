<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>section" class="col-sm-2"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-3"></span>
			<h3 class="panel-title fa fa-book"> CREATE SECTION</h3>
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