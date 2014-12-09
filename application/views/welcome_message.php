<br>
<div class="col-md-4 col-md-offset-4">
  <div class="panel panel-danger">
    
      <div class="panel-heading">
        <h3 class="panel-title">Login</h3>
      </div>

      <div class="panel-body">
      	<?php echo form_open('login/validation');?>
      	
          <div class="form-group">
        		<label class="col-sm-2 control-label">Username</label>
              <?php 
                $data_input_username=array(
                'name'        =>'username',
                'class'       =>'form-control',
                'placeholder' =>'USERNAME',
                'required'=>''
                );
                echo form_input($data_input_username);
              ?>
        	</div>

          <div class="form-group">
          	<label class="col-sm-2 control-label">Password</label>

              <?php 
                $data_input_password=array(
                'name'        =>'password',
                'class'       =>'form-control',
                'placeholder' =>'PASSWORD',
                'required'=>''
                );
                echo form_password($data_input_password);
              ?>
          </div>

          <div class="form-group">
            <?php
              $data_submit_validation=array(
                'name' => 'submit',
                'value'=>'Login',
                'class'=>'col-md-4 pull-right btn btn-primary'
              );

              echo form_submit($data_submit_validation);
            ?>
          </div>

        <?php echo form_close();?>   
      </div>
  </div>
</div>