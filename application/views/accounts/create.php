<div class="col-md-10">
<div class="panel panel-default">
	<div class="panel-heading">
	<a href="#" class="col-sm-1">Back</a><span class="col-sm-4"></span>
	<h3 class="panel-title">Create Account</h3>
	
	</div>
	<div class="panel-body">
	<br>
	<?php echo form_open('link/save_contorller','class="form-horizontal"','role="form"');?>
	<a href="#" class="col-sm-offset-11">Save</a>
	<div class="panel">
		<div class="form-group">
	<label class="col-sm-2 control-label">ID NUMBER:</label>
		<div class="col-sm-2">
			<?php echo form_input('id_number','','class="form-control" placeholder="ID NUMBER"');?>
		</div>
	<label class="col-sm-3 control-label">Acct. Type:</label>
		<div class="col-sm-3">
			<?php $option_acct=array('0'=>'--Select Acct. Type--');
				echo form_dropdown('section',$option_acct,'','class="form-control"'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">USERNAME:</label>
		<div class="col-sm-4">
			<?php echo form_input('username','','class="form-control" placeholder="USERNAME"');?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">PASSWORD:</label>
		<div class="col-sm-4">
			<?php echo form_password('password','','class="form-control" placeholder="PASSWORD"');?>
		</div>
		<div class="col-sm-4">
			<?php echo form_password('password2','','class="form-control" placeholder="CONFIRM PASSWORD"');?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-3 col-sm-offset-2">
			<label class="col-sm-2 control-label">FIRSTNAME</label>
		<?php echo form_input('lastname','','class="form-control" placeholder="FIRSTNAME"');?>
		</div>
		<div class="col-sm-3">
			<label class="col-sm-2 control-label">MIDDLENAME</label>
		<?php echo form_input('lastname','','class="form-control" placeholder="MIDDLENAME"');?>
		</div>
		<div class="col-sm-3">
			<label class="col-sm-2 control-label">LASTNAME</label>
		<?php echo form_input('lastname','','class="form-control" placeholder="LASTNAME"');?>
		</div>
	</div>
	</div>
	
	<?php echo form_close();?>
	</div>
</div>	
</div>
