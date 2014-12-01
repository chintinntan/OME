SELECT election_voter.acct_id AS account_id, elect_voter_id AS voter_id, elect_cand_id AS candidate_id, elect_officer_id AS officer_id

FROM election_voter
LEFT OUTER JOIN election_officer ON election_voter.acct_id = election_officer.acct_id
LEFT OUTER JOIN election_candidate ON election_voter.acct_id = election_candidate.acct_id
LEFT OUTER JOIN election ON election_voter.elect_id = election.elect_id

WHERE election_voter.acct_id = 32
AND election.status = 1