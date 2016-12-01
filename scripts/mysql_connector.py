import MySQLdb
db = MySQLdb.connect(host="localhost", port=3306, user="twitter_handle", passwd="twitter_handle737", db="twitter_handle")
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
