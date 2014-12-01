SELECT 	program.prog_name,
		position.pos_name,
		account.acct_lname,
		account.acct_fname,
		COUNT(candidate_votes.cand_vot_id) AS votes

FROM election_candidate

INNER JOIN candidate_votes ON election_candidate.elect_cand_id = candidate_votes.elect_cand_id
INNER JOIN account ON election_candidate.acct_id = account.acct_id
INNER JOIN election ON election_candidate.elect_id = election.elect_id
INNER JOIN position ON election_candidate.pos_id = position.pos_id
INNER JOIN division ON position.div_id = division.div_id
INNER JOIN course ON account.course_id = course.course_id
INNER JOIN program ON course.prog_id = program.prog_id

WHERE election.status = 1
AND division.div_id = 3
AND program.prog_id = 1

GROUP BY election_candidate.elect_cand_id
ORDER BY position.order_no ASC;