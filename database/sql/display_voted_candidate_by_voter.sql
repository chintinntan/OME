SELECT acct_lname AS last_name, acct_fname AS first_name, pos_name AS postition, div_name AS division

FROM account
INNER JOIN election_candidate ON account.acct_id = election_candidate.acct_id
INNER JOIN candidate_votes ON election_candidate.elect_cand_id = candidate_votes.elect_cand_id
INNER JOIN election_voter ON candidate_votes.elect_voter_id = election_voter.elect_voter_id
INNER JOIN position ON election_candidate.pos_id = position.pos_id
INNER JOIN division ON position.div_id = division.div_id
INNER JOIN election ON election_voter.elect_id = election.elect_id

WHERE election.status = 1
AND election_voter.elect_voter_id = 8192