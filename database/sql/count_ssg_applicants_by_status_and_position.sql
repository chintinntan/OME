SELECT 
position.pos_id,
position.pos_name,
SUM(election_candidate.pos_id AND position.div_id = 1 AND election_candidate.status = 0 AND election.status = 1) AS pending,
SUM(election_candidate.pos_id AND position.div_id = 1 AND election_candidate.status = 1 AND election.status = 1) AS approved,
SUM(election_candidate.pos_id AND position.div_id = 1 AND election_candidate.status = 2 AND election.status = 1) AS rejected,
SUM(election_candidate.pos_id AND position.div_id = 1 AND election.status = 1) AS total

FROM position

LEFT OUTER JOIN election_candidate ON position.pos_id = election_candidate.pos_id
INNER JOIN division ON position.div_id = division.div_id  AND position.div_id = 1
LEFT OUTER JOIN election ON election_candidate.elect_id = election.elect_id AND election.status = 1
LEFT OUTER JOIN account ON election_candidate.acct_id = account.acct_id
LEFT OUTER JOIN course ON account.course_id = course.course_id
LEFT OUTER JOIN program ON course.prog_id = program.prog_id 

GROUP BY position.pos_name
ORDER BY order_no ASC;
