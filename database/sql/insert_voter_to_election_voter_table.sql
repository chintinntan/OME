INSERT INTO election_voter(acct_id,elect_id)
SELECT account.acct_id,election.elect_id
FROM account, election
WHERE election.status = 1;


