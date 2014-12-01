SELECT *

FROM account


INNER JOIN election_candidate ON account.acct_id = election_candidate.acct_id
INNER JOIN election ON election_candidate.elect_id = election.elect_id AND election.status = 1

WHERE elect_cand_id = 1;