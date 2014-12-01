-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `course_voters_statistics`()
BEGIN

SELECT 	course.course_id,
		course.course_name,
		COUNT(election_voter.elect_voter_id) AS Voters

FROM course


INNER JOIN account ON course.course_id = account.course_id
INNER JOIN election_voter ON account.acct_id = election_voter.acct_id
			AND election_voter.elect_id =  (SELECT election.elect_id 
										FROM election.election 
										WHERE election.status=1)
GROUP BY course.course_id 
;
END