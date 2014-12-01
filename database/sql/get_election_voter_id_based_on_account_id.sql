SELECT election_voter.elect_voter_id

FROM account

INNER JOIN election_voter ON account.acct_id = election_voter.acct_id
INNER JOIN election ON election_voter.elect_id = election.elect_id AND election.status = 1

WHERE account.acct_id = 11
;