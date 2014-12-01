SELECT program.prog_id,
		program.prog_code,
		program.prog_name,
		COUNT(election_voter.elect_voter_id) AS Voter,
		COUNT(candidate_votes.elect_cand_id)
		
FROM program
	LEFT OUTER JOIN course ON program.prog_id = course.prog_id 
	LEFT OUTER JOIN account ON course.course_id = account.course_id 
	LEFT OUTER JOIN election_voter ON account.acct_id = election_voter.acct_id  
		AND election_voter.elect_id =  (SELECT election.elect_id 
										FROM election.election 
										WHERE election.status=1)
	LEFT OUTER JOIN candidate_votes ON election_voter.elect_voter_id = candidate_votes.elect_voter_id
	GROUP BY program.prog_id
;