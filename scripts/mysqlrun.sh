mkdir /tmp/candidates

chown mysql:mysql /tmp/candidates

python /var/www/html/electiontweets.xyz/scripts/mysqlbackup.py

zip -j /tmp/candidates.zip /tmp/candidates/*

mv /tmp/candidates.zip /var/www/html/electiontweets.xyz/files

rm -r /tmp/candidates
