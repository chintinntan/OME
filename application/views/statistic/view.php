<div class="col-md-10">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="col-md-5"></span>
			<h3 class="panel-title fa fa-line-chart"> STATISTIC</h3>
		</div>
		<div class="panel-body">
			<div>
				<div class="table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>TITLE EXAM</th>
								<th>DATE</th>
								<th>OPTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								for($x=0;$x<count($exam_list);$x++)
								{
									$exam_title = $exam_list[$x]['title_exam'];
									$exam_date = $exam_list[$x]['exam_date'];
									$exam_id = $exam_list[$x]['exam_schedule_id'];
									$kr20 = $exam_list[$x]['kr20'];
							?>
							<tr>
								<td><?php echo $exam_title ?></td>
								<td><?php echo $exam_date ?></td>
								<td><?php 
										if($kr20==0){

										}
										else
										{

										}
										echo "<a href=".base_url()."teacher_home/view_statistic_result_page/".$exam_id." class='btn btn-sm btn-default'> VIEW</a>";
									?>
										
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
</div>

