import mysql.connector
from Connector import mydb

mycursor = mydb.cursor()

sql = "UPDATE Sensors SET Status = '0' WHERE Id = '5'"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
sql = "INSERT INTO `Event log` (Sensor, ChangeMade) VALUES ('Study room', 'Door Closed')"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
      