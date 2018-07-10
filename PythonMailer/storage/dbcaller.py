#http://www.mysqltutorial.org/python-connecting-mysql-databases/
import mysql.connector
from mysql.connector import Error
 
 
def GetData():
    """ Connect to MySQL database """
    try:
        conn = mysql.connector.connect(host='192.168.2.5',
                                       database='AppInfo',
                                       user='applicationLogin',
                                       password='3applicationway')
        if conn.is_connected():
	    cursor = conn.cursor()
	    query = "select Customer_Name,Address_Line_1 from Customers"
	    cursor.execute(query)
            rows = cursor.fetchall()
 	    return rows
	    #for(Customer_Name,Address_Line_1) in rows:
		#print Customer_Name ,Address_Line_1
    except Error as e:
        print(e)
 
    finally:
        conn.close()
 
 
if __name__ == '__main__':
    workingdata = GetData()
    for (Customer_Name,Address_Line_1) in workingdata:
	print 'customer name:',Customer_Name ,' Address Line 1: ',Address_Line_1