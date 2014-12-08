<div class="col-md-9">
<div class="panel panel-default">
	<div class="panel-heading">
	<a href="#" class="col-sm-1">Back</a><span class="col-sm-4"></span>
	<h3 class="panel-title">Update Account</h3>
	
	</div>
	<div class="panel-body">
	<br>
	<?php echo form_open('link/save_contorller','class="form-horizontal"','role="form"');?>
	<!--Saving account data-->
	<?php 

	$data_submit_account=array(
		'value'=>'SAVE'
		'class'=>'col-sm-offset-11'
		);
	
	echo form_submit($data_submit_account);

	?>
	<div class="panel">
		<div class="form-group">
	<label class="col-sm-2 control-label">ID NUMBER:</label>
		<div class="col-sm-2">
			
			<?php

			$data_input_id=array(
				'name'=>'id_number',
				'class'=>'form-control',
				'placeholder'=>'ID NUMBER'
				); 
				
				echo form_input($data_input_id);
				?>
		</div>
	<label class="col-sm-3 control-label">Acct. Type:</label>
		<div class="col-sm-3">
			<?php

			$option_acct=array(
				'0'=>'--Select Acct. Type--'
				'name'=>'section'
				'class'=>'form-control'
				);

				echo form_dropdown($option_acct); 

				?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">USERNAME:</label>
		<div class="col-sm-4">

			<?php

			$data_input_username=array(
				'name'=>'username',
				'class'=>'form-control',
				'placeholder'=>'USERNAME'
				);

			echo form_input($data_input_username);
			
			?>

		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">PASSWORD:</label>
		<div class="col-sm-4">
			<?php

			$data_input_password=array(
				'name'=>'password',
				'class'=>'form-control',
				'placeholder'=>'PASSWORD'
				);

			 echo form_password($data_input_password);

			 ?>
		</div>
		<div class="col-sm-4">
			<?php
			
			$data_con_password=array(
				'name'=>'password2',
				'class'=>'form-control',
				'placeholder'=>'CONFIRM PASSWORD'
				); 
			
			echo form_password($data_con_password);
			?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-3 col-sm-offset-2">
			<label class="col-sm-2 control-label">FIRSTNAME</label>
		<?php

		$data_input_firstname=array(
			'name'=>'firstname',
			'class'=>'form-control',
			'placeholder'=>'FIRSTNAME'
			); 
		
		echo form_input($data_input_firstname);
		
		?>
		</div>
		<div class="col-sm-3">
			<label class="col-sm-2 control-label">MIDDLENAME</label>
		<?php 

		$data_input_middlename(
			'name'=>'middlename',
			'class'=>'form-control',
			'placeholder'=>'MIDDLENAME'
			);

		echo form_input($data_input_middlename);

		?>
		</div>
		<div class="col-sm-3">
			<label class="col-sm-2 control-label">LASTNAME</label>
		<?php

		$data_input_lastname=array(
			'name'=>'lastname',
			'class'=>'form-control',
			'placeholder'=>'LASTNAME'
			);

		echo form_input($data_input_lastname);

		?>
		</div>
	</div>
	</div>
	
	<?php echo form_close();?>
	</div>
</div>	
</div>