SELECT  election_candidate.elect_cand_id,
	    division.div_name,
		position.pos_name,
		account.acct_lname,
		account.acct_fname

FROM election_candidate

INNER JOIN position ON election_candidate.pos_id = position.pos_id
INNER JOIN account ON election_candidate.acct_id = account.acct_id
INNER JOIN division ON position.div_id = division.div_id
INNER JOIN election_voter ON account.acct_id = election_voter.acct_id
INNER JOIN election ON election_candidate.elect_id = election.elect_id

WHERE election.status = 1
GROUP BY election_candidate.elect_cand_id;
		
	
	
