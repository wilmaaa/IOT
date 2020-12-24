import mysql.connector

mydb = mysql.connector.connect(
    host= "cs2s.yorkdc.net",
    user= "william.hill1",
    password= "Ft3LQT7i6HFSFOrE",
    database= "williamhill1_Sensor"
)

mycursor = mydb.cursor()

sql = "UPDATE Sensors SET Status = '0' WHERE Id = '4'"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
sql = "INSERT INTO `Event log` (Sensor, ChangeMade) VALUES ('Bathroom room', 'Door Closed')"
mycursor.execute(sql)
mydb.commit()
print(mycursor.rowcount, "record inserted.")
      