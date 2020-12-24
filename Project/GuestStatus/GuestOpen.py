import mysql.connector
from Connector import mydb

mycursor = mydb.cursor()

sql = "UPDATE Sensors SET Status = '1' WHERE Id = '2'"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
sql = "INSERT INTO `Event log` (Sensor, ChangeMade) VALUES ('Guest room', 'Door Opened')"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
      