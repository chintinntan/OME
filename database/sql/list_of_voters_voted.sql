SELECT prog_name 

AS 	Program_Name, 
	acct_lname AS Last_Name, 
	acct_fname AS First_Name


FROM candidate_votes
RIGHT OUTER JOIN election_voter ON candidate_votes.elect_voter_id = election_voter.elect_voter_id
INNER JOIN account ON election_voter.acct_id = account.acct_id
INNER JOIN course ON account.course_id = course.course_id
INNER JOIN program ON course.prog_id = program.prog_id
INNER JOIN election ON election_voter.elect_id = election.elect_id


WHERE election_voter.elect_id = 1
AND candidate_votes.cand_vot_id IS NOT NULL
AND election.status = 1
ORDER BY program.prog_name;