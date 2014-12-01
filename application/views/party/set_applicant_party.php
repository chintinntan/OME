<div id="content_header">Set Applicant Party</div>
<div id="body">

	<table>
	<tr>
		<th>No</th>
		<th>Name</th>
		<th>Position</th>
		<th>Options</th>
	</tr>

	<?php

		$applicant_ctr = 0;

		for($x=0;$x<count($page_view_data);$x++)
		{
			$candidate_name = 	$page_view_data[$x]['acct_lname'].", ".
								$page_view_data[$x]['acct_fname']." ".
								$page_view_data[$x]['acct_mname'];

			$position = $page_view_data[$x]['pos_name'];
			echo '<tr>';
			echo '<td>'.++$applicant_ctr.'</td>';
			echo '<td>'.$candidate_name.'</td>';	
			echo '<td>'.$position.'</td>';

			$candidate_id = $page_view_data[$x]['elect_cand_id'];
			$url1 = site_url('set_applicant_party/set_party/'.$candidate_id);

			echo '<td><a href="'.$url1.'">Set Party</a>';	
			echo '</tr>';
		}
	?>
</table>
</div>