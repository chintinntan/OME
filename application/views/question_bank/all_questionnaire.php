<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."question_bank/create_page/".$this->uri->segment(3,0)."/".$this->uri->segment(4,0)." class='btn btn-sm btn-info fa fa-pencil-square' title='Create Questionnaire'>";?></a>
			<h3 class="panel-title fa fa-file col-sm-offset-5"> QUESTIONNAIRE</h3>
		</div>

		<?php if($questions != NULL){ ?>
		<div class="panel-body">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<td><label>SUBJECT</label></td>
						<td><b><?php echo $subj_name;?></b></td>
					</tr>
					<tr>
						<td></td>
						<td><?php echo "<a href=".base_url()."question_bank/question_bank_page/".$subj_id." class='btn btn-sm btn-primary fa fa-retweet' title='QUESTION BANK'> QUESTION BANK"; ?></a></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>	
				</table>
			</div>
			
			
			
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>QUESTION</th>
							<th></th>
						</tr>	
					</thead>
					<?php
						$counter=0; 
						for($x=0;$x<count($questions);$x++)
						{
							$question = $questions[$x]['question'];
							$question_id = $questions[$x]['questionnaire_id'];
							$counter += 1;
					?>
					<tbody>
						<tr>
							<td><?php echo $counter ?></td>
							<td><?php echo $question ?></td>
							<td>
								<?php $this->load->helper('inflector'); ?>
								<?php echo "<a href=".base_url()."question_bank/update_page/".$question_id."/".underscore($subj_name)."/".$subj_id." class='btn btn-sm btn-danger fa fa-pencil-square-o' title='Update Questionnaire'>";?></a>
								<?php echo "<a href=".base_url()."question_bank/add_choices_page/".$question_id."/".underscore($subj_name)."/".$subj_id." class='btn btn-sm btn-success fa fa-plus-square' title='Add Choices'>";?></a>
								<?php echo "<a href=".base_url()."question_bank/choices_page/".$question_id."/".underscore($subj_name)."/".$subj_id." class='btn btn-sm btn-primary fa fa-retweet' title='Change Choices'>";?></a>
								
							</td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
		<?php } else{ ?>
		<div class="panel-body">
			<div class="col-md-5">
				<table class="table">
					<tr>
						<td><label>SUBJECT</label></td>
						<td><b><?php echo $subj_name;?></b></td>
					</tr>
					<tr>
						<td></td>
						<td><?php echo "<a href=".base_url()."question_bank/question_bank_page/".$subj_id." class='btn btn-sm btn-primary fa fa-retweet' title='QUESTION BANK'> QUESTION BANK"; ?></a></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>	
				</table>
			</div>
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>QUESTION</th>
							<th></th>
							
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