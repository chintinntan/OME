-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ssg_applicants_without_party`()
BEGIN
	SELECT 	elect_cand_id, 
			UPPER(acct_lname) AS acct_lname, 
			UPPER(acct_fname) AS acct_fname, 
			UPPER(acct_mname) AS acct_mname, 
			pos_name

	FROM election_candidate
	INNER JOIN election ON election_candidate.elect_id = election.elect_id
	INNER JOIN position ON election_candidate.pos_id = position.pos_id
	INNER JOIN account ON election_candidate.acct_id = account.acct_id

	WHERE party_id IS NULL
	AND election.status = 1
	AND position.div_id = 1;
END