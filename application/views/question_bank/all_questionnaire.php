<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."question_bank/create_page/".$this->uri->segment(3,0)."/".$this->uri->segment(4,0)." class='col-sm-1'> CREATE";?></a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title fa fa-database"> QUESTION BANK</h3>
		</div>

		<?php if($questions != NULL){ ?>
		<div class="panel-body">
			<label class="control-label">SUBJECT: </label>
			<?php echo $subj_name;?>
			<div class="table table-responsive">
				<table class="table">
					<?php 
						for($x=0;$x<count($questions);$x++)
						{
							
						}
					?>
					<thead>
						<tr>
							<th>No.</th>
							<th>QUESTION</th>
							<th>OPTION</th>
							
						</tr>	
					</thead>

					<tbody>
						<tr>
							<td>1</td>
							<td>questionnaire po</td>
							<td>
								<?php echo "<a href=".base_url()."question_bank/update_page/".$this->uri->segment(3,0)."/".$this->uri->segment(4,0)." class='btn btn-sm btn-default'> UPDATE";?></a>
								<a href="<?php echo base_url();?>question_bank/add_choices_page" class="btn btn-sm btn-default">ADD CHOICES</a>
								<a href="<?php echo base_url();?>question_bank/update_choices_page" class="btn btn-sm btn-default">UPDATE CHOICES</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php } else{ ?>
		<div class="panel-body">
			<label class="control-label">SUBJECT: </label>
			<?php echo $subj_name;?>
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>QUESTION</th>
							<th>OPTION</th>
							
						</tr>	
					</thead>

					<tbody>
						<tr>
							<td>1</td>
							<td>NO RECORD</td>
							<td>
								N/A
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php } ?>
	</div>
</div>