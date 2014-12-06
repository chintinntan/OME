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
  	<input type="type" name="username" class="form-control" placeholder="Username">
  	</div>
    <div class="form-group">
    	<label class="col-sm-2 control-label">Password</label>
    	<input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
    	<input type="submit" value="OK" class="col-md-4 pull-right btn btn-primary">
    </div>
    <?php echo form_close();?>
  </div>
</div>
</div>