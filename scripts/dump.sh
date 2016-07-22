cd ..
rm files/*
cd files

host="localhost"
port=3306
user="twitter_handle"
password="twitter_handle737"
database="twitter_handle"

for x in `mysql --skip-column-names -u$user -p$password $database -e 'show tables;'`; do
	mysqldump -u $user -p$password --fields-terminated-by=',' --tab='/tmp' $database $x > $x.csv
done

zip backup.zip *
