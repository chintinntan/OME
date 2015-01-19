<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>question_bank/create_page" class="col-sm-1"> CREATE</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title fa fa-database"> QUESTION BANK</h3>
		</div>

		<div class="panel-body">
			<label class="control-label">SUBJECT: </label>
			<?php echo "Subject name";?>
			<div class="table table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th class="row-id">No.</th>
							<th class="row-question">QUESTION</th>
							<th class="row-option">OPTION</th>
							
						</tr>	
					</thead>

					<tbody>
						<tr>
							<td>1</td>
							<td>asdasdas asdas dasd asdas asdasdasdas questionnaire po asdas dasd asd asd asd</td>
							<td>
								<a href="<?php echo base_url();?>question_bank/update_page" class="btn btn-sm btn-default">UPDATE</a>
								<a href="<?php echo base_url();?>question_bank/add_choices_page" class="btn btn-sm btn-default">ADD CHOICES</a>
								<a href="<?php echo base_url();?>question_bank/update_choices_page" class="btn btn-sm btn-default">UPDATE CHOICES</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>