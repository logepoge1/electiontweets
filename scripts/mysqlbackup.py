import MySQLdb
from election_config import *

db = MySQLdb.connect(host=host, port=port, user=user, passwd=password, db=database)
cur = db.cursor()

candidateArray = ['DrJillStein', 'GovGaryJohnson', 'HillaryClinton', 'realDonaldTrump', 'SenSanders']

for candidate in candidateArray:
	sql = """SELECT twitter_id, tweet, created_at, retrieve_date FROM %s INTO OUTFILE '/tmp/candidates/%s.csv' FIELDS ENCLOSED BY '"' TERMINATED BY ';' ESCAPED BY '"' LINES TERMINATED BY '\r\n';""" % (candidate, candidate)
	cur.execute(sql)

db.close()
