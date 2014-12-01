<h1>Set Party</h1>
<div id="body">
<?php
	$candidate_name = $page_view_data[0]["acct_lname"].", ".$page_view_data[0]["acct_fname"].
	" ".$page_view_data[0]["acct_mname"];
	echo $candidate_name;

	for($x=0;$x<count($party);$x++)
	{
		$options[$party[$x]['party_id']] = $party[$x]['party_name'];
	}

	$options['default'] = 'Please select party';

	$attributes = array( 
							'id' 		=> 'myform',
							'method' 	=> 'post'
					);

	$this->load->helper('url');
	$this->load->helper('form');

	echo form_open('set_applicant_party/update_party',$attributes);
	echo form_dropdown('party_id', $options, 'default');
	echo form_hidden('candidate_id', $page_view_data[0]["candidate_id"]);
	echo form_submit('mysubmit', 'Set');
	echo form_close();
?>
</table>
</div>