SELECT EXISTS(SELECT *
				FROM candidate_votes
				INNER JOIN election_voter ON candidate_votes.elect_voter_id = election_voter.elect_voter_id
				INNER JOIN election ON election_voter.elect_id = election.elect_id

				WHERE election_voter.acct_id = 1
				AND election.status = 1) AS Result;