from twython import Twython
from mysql_connector import insert
from mysql_connector import query
from election_config import *
import time
import sys

api = Twython(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_KEY,ACCESS_SECRET)

candidateArray = ['realDonaldTrump', 'DrJillStein', 'GovGaryJohnson', 'HillaryClinton', 'SenSanders']

for candidate in candidateArray:
        candidateSql = "SELECT twitter_id FROM " + candidate + " ORDER BY twitter_id DESC LIMIT 1"
        last_id = query(candidateSql)
        try:
                if last_id is None:
                        user_timeline = api.get_user_timeline(screen_name=candidate, count=200)
                else:
                        last_id = int(last_id[0]) + 1
                        user_timeline = api.get_user_timeline(screen_name=candidate, count=200, since_id=last_id)
                counter = 0
        except TwythonError,e:
                sys.exit(0)
        for tweet in user_timeline:
                counter = counter + 1
                text = tweet['text'].encode("ascii", "ignore")
                id = tweet['id']
                created_at = time.strftime('%Y-%m-%d %H:%M:%S', time.strptime(tweet['created_at'],'%a %b %d %H:%M:%S +0000 %Y'))
                query = "INSERT INTO " + candidate + "(twitter_id, tweet, created_at) VALUES(%s, %s, %s) "
                try:
                        insert(query, id, text, created_at)
                except Exception,e:
                        pass
