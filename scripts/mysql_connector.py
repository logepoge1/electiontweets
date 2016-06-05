import MySQLdb
from election_config import *

db = MySQLdb.connect(host=host, port=port, user=user, passwd=password, db=database)
cur = db.cursor()

def insert(query, id, text, created_at):
	try:
		cur.execute(query, (id, text, created_at))
		db.commit()
		#db.close()
	except Exception,e:
		print str(e)
		print e
		print("Error in mysql")
		pass

def query(query):
	cur.execute(query)
	return cur.fetchone()
