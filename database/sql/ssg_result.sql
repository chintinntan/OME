SELECT 	position.pos_id,
		position.pos_name,
		account.acct_lname,
		account.acct_fname,
		program.prog_code,
		COUNT(candidate_votes.cand_vot_id) AS votes

FROM election_candidate

LEFT OUTER JOIN candidate_votes ON election_candidate.elect_cand_id = candidate_votes.elect_cand_id 				
RIGHT OUTER JOIN account ON election_candidate.acct_id = account.acct_id
LEFT OUTER JOIN course ON account.course_id = course.course_id
LEFT OUTER JOIN program ON course.prog_id = program.prog_id					
LEFT OUTER JOIN election ON election_candidate.elect_id = election.elect_id
RIGHT OUTER JOIN position ON election_candidate.pos_id = position.pos_id 
		 
		AND election_candidate.status = 1
		AND election_candidate.elect_id = (	SELECT election.elect_id 
											FROM election 
											WHERE election.status = 1)
LEFT OUTER JOIN division ON position.div_id = division.div_id



GROUP BY election_candidate.elect_cand_id, position.pos_id
ORDER BY order_no ASC, account.acct_lname ASC;
