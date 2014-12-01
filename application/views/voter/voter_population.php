<div id="container_1">ELECTION TURNOUT</div>
<div id="container_2">
<?php
	
	$table = array(	'table'		=>	'<table>',
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
		echo $table['th'].'Program Code'.$table['th_'];
		echo $table['th'].'Program Name'.$table['th_'];
		echo $table['th'].'Population'.$table['th_'];
		echo $table['th'].'Voters'.$table['th_'];
		echo $table['th'].'Percentage'.$table['th_'];
	echo $table['tr_'];

	$total_population = 0;
	$total_voters = 0;

	for($x=0; $x<count($page_view_data);$x++)
	{
		if($voters[$x]['prog_id'])
		{
			if($voters[$x]['prog_id'] == $page_view_data[$x]['prog_id'])
			{
				$election_turnout[$x]['code'] = $page_view_data[$x]['prog_code'];
				$election_turnout[$x]['program'] = $page_view_data[$x]['prog_name'];
				$election_turnout[$x]['population'] = $page_view_data[$x]['population'];
				$election_turnout[$x]['voters'] = $voters[$x]['voters'];
				$election_turnout[$x]['percentage'] = round(($voters[$x]['voters']/$page_view_data[$x]['population'])*100,2);
				$total_population = $total_population + $page_view_data[$x]['population'];
				$total_voters = $total_voters + $voters[$x]['voters'];
				$percentage = round(($total_voters/$total_population)*100,2);
			}
		}
	}

	for($x=0; $x<count($election_turnout);$x++)
	{
		echo $table['tr'];
		echo $table['td'].$election_turnout[$x]['code'].$table['td_'];
		echo $table['td'].$election_turnout[$x]['program'].$table['td_'];
		echo $table['td'].$election_turnout[$x]['population'].$table['td_'];
		echo $table['td'].$election_turnout[$x]['voters'].$table['td_'];
		echo $table['td'].$election_turnout[$x]['percentage'].$table['td_'];
		echo $table['tr_'];
	}
	echo '<tr>';
	echo '<td colspan=2>Total</td>';
	echo '<td>'.$total_population.'</td>';
	echo '<td>'.$total_voters.'</td>';
	echo '<td>'.$percentage.'</td>';
	echo '</tr>';

	echo $table['table_'];
?>
</div>