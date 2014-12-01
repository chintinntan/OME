SELECT 	election_voter.elect_voter_id,
		acct_lname AS lname, 
		acct_fname AS fname, 
		acct_mname AS mname

FROM election_voter
LEFT OUTER JOIN election_candidate ON election_voter.acct_id = election_candidate.acct_id
INNER JOIN account ON election_voter.acct_id = account.acct_id
INNER JOIN election ON election_voter.elect_id = election.elect_id


AND account.acct_id = 9
AND election.status = 1