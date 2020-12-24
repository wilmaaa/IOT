import upymysql
import upymysql.cursors

mydb = mysql.connector.connect(
    host= "cs2s.yorkdc.net",
    user= "william.hill1",
    password= "Ft3LQT7i6HFSFOrE",
    database= "williamhill1_Sensor"
)

connection = upymysql.connect(host='cs2s.yorkdc.net',
                             user='william.hill1',
                             password='Ft3LQT7i6HFSFOrE',
                             db='williamhill1_Sensor',
                             charset='utf8mb4',
                             cursorclass=upymysql.cursors.DictCursor)

try:

     with connection.cursor() as cursor:
        # updates door status too closed
        sql = "UPDATE Sensors SET Status = '1' WHERE Id = '0'"

    # connection is not autocommit by default. So you must commit to save
    # your changes.
    connection.commit()

    with connection.cursor() as cursor:
        # Updates the Update log
        sql = "INSERT INTO `Event log` (Sensor, ChangeMade) VALUES ('Wills room', 'Door Opened')"
    connection.commit()
        
finally:
    connection.close()


      