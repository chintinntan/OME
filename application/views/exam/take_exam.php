<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="col-md-5"></span>
			<h3 class="panel-title">EXAMINATION</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open();
				echo "<div class='list-group'>";
					echo "<label>QUESTION</label>";
					echo "<ul style='list-style-type:none'>";
						echo "<li>";
							
							$data_radio=array(
								'name'=>'answer_btn',
								'value'=>'from database correct'
							);
							echo form_radio($data_radio);
							echo "choices";
							
						echo "</li>";
					echo "</ul>";	
				echo "</div>";
				
			
				$data=array(
					'class'=>'btn btn-success',
					'value'=>'SUBMIT'
				);
				echo form_submit($data); 
				echo form_close();
			?>
		</div>
	</div>
</div>
