<div class="col-md-10">
	<div class="panel panel-default">

		<div class="panel-heading">
			<a href="<?php echo base_url(); ?>admin_home/human_resource" class="col-sm-1"><i class=" fa fa-reply"></i> Back</a><span class="col-sm-4"></span>
			<h3 class="panel-title fa fa-users"> CREATE ACCOUNT</h3>
		</div>

		<div class="panel-body">
			<?php echo form_open('account/create_new_account','class="form-horizontal"','role="form"');?><!--Saving account data-->
				
				<?php if (form_error('id_number')): ?>
						<div class="form-group has-error">
						<?php else: ?>
				<div class="form-group">
						<?php endif; ?>	
					<label class="col-sm-2 control-label">ID NUMBER:</label>
					<div class="col-sm-4">
							<?php
								$data_input_id=array(
									'name'=>'id_number',
									'value'=>set_value('id_number'),
									'class'=>'num_only form-control',
									'placeholder'=>'ID NUMBER',
									'required'=>''
								); 
								echo form_input($data_input_id);
								echo form_error('id_number');
							?>
					</div>
				</div>

				<div class="form-group">			
					<label class="col-sm-2 control-label">Acct. Type:</label>
					<div class="col-sm-2">
							<?php
								for($x=0;$x<count($dropdown_acct_type);$x++)
								{
								$options [$dropdown_acct_type[$x]['account_type_id']] = $dropdown_acct_type[$x]['label'];
								}
							?>
								<div class="">
							<?php
									echo form_dropdown('acct_type',$options,'','class="form-control"'); 
							?>
						</div>
					</div>
				</div>

						
				<?php if (form_error('username')): ?>
						<div class="form-group has-error">
						<?php else: ?>
				<div class="form-group">
						<?php endif; ?>	
					<label class="col-sm-2 control-label">USERNAME:</label>
					<div class="col-sm-4">
						<?php
								$data_input_username=array(
									'name'=>'username',
									'value'=>set_value('username'),
									'class'=>'form-control',
									'placeholder'=>'USERNAME',
									'required'=>''
								);
								echo form_input($data_input_username);
								echo form_error('username');
						?>
					</div>
				</div>

				<?php if (form_error('password')): ?>
						<div class="form-group has-error">
						<?php else: ?>
				<div class="form-group">
						<?php endif; ?>
					<label class="col-sm-2 control-label">PASSWORD:</label>
					<div class="col-sm-4">
						<?php
								$data_input_password=array(
									'name'=>'password',
									'value'=>set_value('password'),
									'class'=>'form-control',
									'placeholder'=>'PASSWORD',
									'required'=>''
								);
			 					echo form_password($data_input_password);
			 					
			 			?>
					</div>

					<div class="col-sm-4">
						<?php
								$data_con_password=array(
									'name'=>'password2',
									'value'=>set_value('password2'),
									'class'=>'form-control',
									'placeholder'=>'CONFIRM PASSWORD',
									'required'=>''
								); 
								echo form_password($data_con_password);
						?>
					</div>

				</div>
				
				<?php echo "<div class='col-md-offset-2'>".form_error('password')."</div><br>";?>
						
				<div class="form-group">
					<div class="col-sm-3 col-sm-offset-2">
						<label class="col-sm-2 control-label">FIRSTNAME</label>
						<?php
								$data_input_firstname=array(
									'name'=>'firstname',
									'value'=>set_value('firstname'),
									'class'=>'txt_only form-control',
									'placeholder'=>'FIRSTNAME',
									'required'=>''
								); 	
								echo form_input($data_input_firstname);
								echo form_error('firstname');	
						?>
					</div>
		
					<div class="col-sm-3">
						<label class="col-sm-2 control-label">MIDDLENAME</label>
						<?php 
								$data_input_middlename=array(
									'name'=>'middlename',
									'value'=>set_value('middlename'),
									'class'=>'txt_only form-control',
									'placeholder'=>'MIDDLENAME',
									'required'=>''
								);
								echo form_input($data_input_middlename);
								echo form_error('middlename');
						?>
					</div>
						
					<div class="col-sm-3">
						<label class="col-sm-2 control-label">LASTNAME</label>
						<?php
							$data_input_lastname=array(
								'name'=>'lastname',
								'value'=>set_value('lastname'),
								'class'=>'txt_only form-control',
								'placeholder'=>'LASTNAME',
								'required'=>''
							);
							echo form_input($data_input_lastname);
							echo form_error('lastname');
						?>
					</div>
				</div>
				
				<?php
					$data_submit_account=array(
						'value'=>'SAVE',
						'class'=>'col-sm-6 col-sm-offset-2 btn btn-sm btn-primary'
					);
					echo form_submit($data_submit_account);
				?>
	
			<?php echo form_close();?>

		</div>

	</div>	
</div>
