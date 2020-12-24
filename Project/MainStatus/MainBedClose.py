import mysql.connector
import Connector

mycursor = mydb.cursor()

sql = "UPDATE Sensors SET Status = '0' WHERE Id = '6'"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
sql = "INSERT INTO `Event log` (Sensor, ChangeMade) VALUES ('MainBed room', 'Door Closed')"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
      