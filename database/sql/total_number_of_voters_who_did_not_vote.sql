SELECT 	program.prog_id,
		program.prog_code AS Program,
		program.prog_name,
		COUNT(election_voter.acct_id) AS total_voters,
		COUNT(candidate_votes.elect_voter_id) AS voters,
		COUNT(election_voter.acct_id)-COUNT(candidate_votes.elect_voter_id) non_voters

FROM program
	INNER JOIN course ON program.prog_id = course.prog_id
	INNER JOIN account ON course.course_id = account.course_id
	INNER JOIN election_voter ON account.acct_id = election_voter.acct_id
	INNER JOIN election ON election_voter.elect_id = election.elect_id
	LEFT OUTER JOIN candidate_votes ON election_voter.elect_voter_id = candidate_votes.elect_voter_id
	

WHERE election.status = 1
GROUP BY program.prog_id;


