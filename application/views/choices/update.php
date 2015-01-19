<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="<?php echo base_url();?>question_bank/questionnaire" class="col-sm-1"><i class="fa fa-reply"></i> BACK</a>
			<span class="col-sm-4"></span>
			<h3 class="panel-title fa fa-file"> UPDATE CHOICES</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<tr>
					<td><b>Question</b></td>
					<td>this question</td>
				</tr>
			</div>
			<?php echo form_open('','form-horizontal');?>
				<div class="col-md-6 col-md-offset-3">
					<div class="table table-responsive">
						<br>
						<table class="table">
							<tr>
								<td>CHOICE A
									<br>
									<?php
										$data_input_radio_a=array(
											'name'=>'radio',
											'id'=>'option_radio1',
											'value'=>'option1'
										);
										echo form_radio($data_input_radio_a);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_a=array(
											'name'=>'choice1',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 1',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_a);
									?>
								</td>
							</tr>

							<tr>
								<td>CHOICE B
									<br>
									<?php
										$data_input_radio_a=array(
											'name'=>'radio',
											'id'=>'option_radio2',
											'value'=>'option1'
										);
										echo form_radio($data_input_radio_a);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_b=array(
											'name'=>'choice2',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 2',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_b);
									?>
								</td>
							</tr>
							<tr>
								<td>CHOICE C
									<br>
									<?php
										$data_input_radio_c=array(
											'name'=>'radio',
											'id'=>'option_radio3',
											'value'=>'option3'
										);
										echo form_radio($data_input_radio_c);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_c=array(
											'name'=>'choice3',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 3',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_c);
									?>
								</td>
							</tr>
							<tr>
								<td>CHOICE D
									<br>
									<?php
										$data_input_radio_d=array(
											'name'=>'radio',
											'id'=>'option_radio4',
											'value'=>'option4'
										);
										echo form_radio($data_input_radio_d);
									?>
								</td>
								<td>
									<?php
										$data_input_choice_d=array(
											'name'=>'choice4',
											'class'=>'form-control',
											'placeholder'=>'CHOICE # 4',
											'required'=>'',
											'rows'=>'2',
										); 	
										echo form_textarea($data_input_choice_d);
									?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" class="btn btn-default pull-right" value="SUBMIT"></td>
							</tr>
						</table>
					</div>
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>