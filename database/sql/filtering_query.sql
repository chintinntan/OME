SELECT * FROM election_candidate,election_voter,election
WHERE  election_voter.acct_id = election_candidate.acct_id
AND election_candidate.elect_id = election.elect_id
AND election_candidate.acct_id = 1
AND election.status=1;