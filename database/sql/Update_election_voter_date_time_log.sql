UPDATE election.election_voter
SET date_time_log = (SELECT account.time_date_log
					 FROM account
					 WHERE account.acct_id = election_voter.acct_id)


WHERE EXISTS (SELECT * FROM account WHERE account.acct_id = election_voter.acct_id);
