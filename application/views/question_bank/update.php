<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<a href=".base_url()."question_bank/questionnaire/".$this->uri->segment(3,0)."/".$this->uri->segment(4,0)." class='col-sm-1'> BACK";?></a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title fa fa-file"> UPDATE QUESTION</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<?php echo form_open('','class="form-horizontal"');?>
					<div class="table table-responsive">
						<table class="table">
							<tr>
								<td>Subject</td>
								<td>
									<?php 
										$data=array('subject'=>'sort by subject of the list of student');
										echo form_dropdown('subject',$data,'','class="form-control"');
									?>
								</td>
							</tr>
							<tr>
								<td>PERIOD</td>
								<td>
									<?php 
										$data=array('period'=>'sort by period');
										echo form_dropdown('subject',$data,'','class="form-control"');
									?>
								</td>
							</tr>
							<tr>
								<td>Question</td>
								<td>
									<?php
										$data_input_questionnaire=array(
											'name'=>'questionnaire',
											'class'=>'form-control',
											'placeholder'=>'QUESTIONNAIRE INPUT',
											'required'=>'',
											'rows'=>'5'
										); 
										echo form_textarea($data_input_questionnaire);
									?>
								</td>
							</tr>

							<tr>
								<td></td>
								<td><input type="submit" class="btn col-sm-offset-10"></td>
							</tr>
						</table>
					</div>
				<?php echo form_close();?>
			</div>		
		</div>
	</div>
</div>