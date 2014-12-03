<h1>Admin Home</h1>
<div id="body">

<?php
	
	$table = array(		'table'		=>	'<table>',
						'table_'	=>	'</table>',
						'tr'		=>	'<tr>',
						'tr_'		=>	'</tr>',
						'th'		=>	'<th>',
						'th_'		=>	'</th>',
						'td'		=>	'<td>',
						'td_'		=>	'</td>'
					);

	echo $table['table'];

	echo $table['tr'];
	echo $table['td'].'Position Applied '.$table['td_'];
	echo $table['td'].$page_view_data['position'].$table['td_'];
	echo $table['tr_'];

	echo $table['tr'];
	echo $table['td'].'Division '.$table['td_'];
	echo $table['td'].$page_view_data['division'].$table['td_'];
	echo $table['tr_'];

	echo $table['tr'];
	echo $table['td'].'Date of Application '.$table['td_'];
	echo $table['td'].$page_view_data['log'].$table['td_'];
	echo $table['tr_'];


	if($page_view_data['status'] == 0)
	{
		$status = 'Pending';
	}
	elseif ($page_view_data['status'] == 1) 
	{
		$status = 'Approved';
	}
	elseif ($page_view_data['status'] == 2) 
	{
		$status = 'Rejected';
	}
	else
	{
		$status = 'See UIC COMELEC';
	}

	echo $table['tr'];
	echo $table['td'].'Status '.$table['td_'];
	echo $table['td'].$status.$table['td_'];
	echo $table['tr_'];
	

	echo $table['table_'];
?>

</div>
