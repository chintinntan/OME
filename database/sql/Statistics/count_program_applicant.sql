SELECT 	program.prog_name,
		SUM(election_candidate.pos_id AND division.div_id = 2 AND election_candidate.status = 0 ) AS Pending,
		SUM(election_candidate.pos_id AND division.div_id = 2 AND election_candidate.status = 2 ) AS Rejected,
		SUM(election_candidate.pos_id AND division.div_id = 2 AND election_candidate.status = 1 ) AS Approved,
		SUM(election_candidate.pos_id AND division.div_id = 2) AS Total

FROM position
RIGHT OUTER JOIN election_candidate ON position.pos_id = election_candidate.pos_id
RIGHT OUTER JOIN account ON election_candidate.acct_id = account.acct_id
LEFT OUTER JOIN course ON account.course_id = course.course_id
LEFT OUTER JOIN program ON course.prog_id = program.prog_id
LEFT OUTER JOIN division ON position.div_id = division.div_id
INNER JOIN election ON election_candidate.elect_id = election.elect_id


WHERE election.status = 1
GROUP BY program.prog_name
ORDER BY prog_name ASC;