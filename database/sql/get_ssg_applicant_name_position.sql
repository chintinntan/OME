SELECT acct_lname, acct_fname, acct_mname, pos_name, div_name

FROM account
INNER JOIN election_candidate ON account.acct_id = election_candidate.acct_id
INNER JOIN position ON election_candidate.pos_id = position.pos_id
INNER JOIN election ON election_candidate.elect_id = election.elect_id
INNER JOIN division ON position.div_id = position.div_id

WHERE election.status = 1
AND elect_cand_id = 39

GROUP BY account.acct_id