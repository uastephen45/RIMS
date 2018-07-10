#http://www.mysqltutorial.org/python-connecting-mysql-databases/
import mysql.connector
from mysql.connector import Error
import urllib2
import smtplib
from os.path import basename
from email.mime.application import MIMEApplication
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.base import MIMEBase
from email import encoders
import time 
from threading import Thread
  
def addrequiredattachments(ResID,msg):
	formsdata = getformsdata(ResID)
	for item in formsdata:		
		Form_ID = item[0]
		Form_Name = item[1]
		FormURL = item[2]
		msg.attach(MIMEText(Form_Name))
		with open(FormURL, "r") as fil:
	    		part = MIMEApplication(
			fil.read(),
			Name=basename(Form_Name)
	    	)
		# After the file is closed
		part['Content-Disposition'] = 'attachment; filename="%s"' % basename(Form_Name)
		msg.attach(part)








def populateLineItems(resID):
	resItems = getReservationItemData(resID)
	htmltoReturn = ""
	for item in resItems:
		EquipmentType = item[7]
		Duration_Option = item[8]
		Equipment_Count = item[2]
		Equipment_Form_Status = item[3]
		Item_Start_Time = item[4]
		Duration_Cost_Adult = item[5]
		Duration_Cost_Child = item[6]
		Equipment_Count_Adult = item[0]
		Equipment_Count_Child = item[1]
		Cost_Adult = Duration_Cost_Adult * Equipment_Count_Adult
		Cost_Child = Duration_Cost_Child * Equipment_Count_Child

		if(Equipment_Count_Child > 0):

			with open('forms/AdultChildForm.html','r') as myHtmlFile:
				basehtml = myHtmlFile.read()
				basehtml = basehtml.replace('{{rentaltype}}',EquipmentType)
				basehtml = basehtml.replace('{{starttime}}',Item_Start_Time.strftime("%d-%b-%Y-%H:%M:%S"))
				basehtml = basehtml.replace('{{totalcount}}',str(Equipment_Count))
				basehtml = basehtml.replace('{{Acost}}',str(Duration_Cost_Adult))
				basehtml = basehtml.replace('{{Acount}}',str(Equipment_Count_Adult))
				basehtml = basehtml.replace('{{Ccost}}',str(Duration_Cost_Child))
				basehtml = basehtml.replace('{{Ccount}}',str(Equipment_Count_Child))
				basehtml = basehtml.replace('{{TCcost}}',str(Cost_Child))
				basehtml = basehtml.replace('{{TAcost}}',str(Cost_Adult))
				basehtml = basehtml.replace('{{duration}}',Duration_Option)
				htmltoReturn = htmltoReturn + basehtml	

		if(Equipment_Count_Child == 0):

			with open('forms/AdultForm.html','r') as myHtmlFile:
				basehtml = myHtmlFile.read()
				basehtml = basehtml.replace('{{rentaltype}}',EquipmentType)
				basehtml = basehtml.replace('{{starttime}}',Item_Start_Time.strftime("%d-%b-%Y-%H:%M:%S"))
				basehtml = basehtml.replace('{{totalcount}}',str(Equipment_Count))
				basehtml = basehtml.replace('{{Acost}}',str(Duration_Cost_Adult))
				basehtml = basehtml.replace('{{Acount}}',str(Equipment_Count_Adult))
				basehtml = basehtml.replace('{{Ccount}}',str(Equipment_Count_Child))
				basehtml = basehtml.replace('{{TAcost}}',str(Cost_Adult))
				basehtml = basehtml.replace('{{duration}}',Duration_Option)
				htmltoReturn = htmltoReturn + basehtml		
		print EquipmentType
	return htmltoReturn



def SendMail(dataitem):
	ResID = dataitem[0]
	Customer_Name = dataitem[1]
	Start_Date = dataitem[3]
	End_Date = dataitem[4]
	Email_Address = dataitem[2]
	s = smtplib.SMTP('smtp.gmail.com', 587)
        s.starttls()

	fromaddr = "noreplyntr@gmail.com"
	toaddr = Email_Address
        s.login(fromaddr, "3sweptaway")
	msg = MIMEMultipart()
	msg['From'] = fromaddr
	msg['To'] = toaddr
	msg['Subject'] = "NTR Reservation Information For " + Customer_Name



	with open('forms/MainReservationForm.html','r') as myHtmlFile:
		basehtml = myHtmlFile.read()
	basehtml = basehtml.replace('{{customername}}',Customer_Name)
	basehtml = basehtml.replace('{{startdate}}',Start_Date.strftime('%m/%d/%Y'))
	basehtml = basehtml.replace('{{enddate}}',End_Date.strftime('%m/%d/%Y'))
	
	body = basehtml +populateLineItems(ResID)
	addrequiredattachments(ResID,msg)
	body = body + ""



        '''
	msg.attach(MIMEText("item.txt"))



	with open("forms/item.txt", "r") as fil:
    		part = MIMEApplication(
        	fil.read(),
        	Name=basename("item.txt")
    	)
        # After the file is closed
        part['Content-Disposition'] = 'attachment; filename="%s"' % basename("item.txt")
        msg.attach(part)

	with open("forms/item.txt", "r") as fil:
    		part = MIMEApplication(
        	fil.read(),
        	Name=basename("item.txt")
    	)
        # After the file is closed
        part['Content-Disposition'] = 'attachment; filename="%s"' % basename("item.txt")
        msg.attach(part)
        '''




	msg.attach(MIMEText(body, 'html'))
	
	text = msg.as_string()
	s.sendmail(fromaddr, toaddr, text)
	s.quit()
	contents = urllib2.urlopen("http://192.168.2.7/phpscripts/updateReservationStatus.php/?resID="+str(ResID)+"&newStatusID=3").read()
def getReservationItemData(resID):
    """ Connect to MySQL database """
    try:
        conn = mysql.connector.connect(host='192.168.2.7',
                                       database='AppInfo',
                                       user='applicationLogin',
                                       password='3applicationway')
        if conn.is_connected():
	    cursor = conn.cursor()
	    
	    query = "select Equipment_Count_Adult,Equipment_Count_Child,Equipment_Count,Equipment_Form_Status,Item_Start_Time,VED.Duration_Cost_Adult,VED.Duration_Cost_Child,EquipmentType,Duration_Option from  ReservationItems RI JOIN ValidEquipmentTypes VET on RI.Equipment_ID = VET.ID Join ValidEquipmentDurations VED on RI.Equipment_Duration_ID = VED.ID where RI.Reservation_ID =" +str(resID)
            #query = "select RIF.ID, Reservation_ID,Customer_Name, Email_Address,HTML_CODE from ReservationItemsForms RIF join Customers C on RIF.Customer_ID = C.ID join ValidEquipmentForms VEF on RIF.Form_ID = VEF.ID"
	    cursor.execute(query)
            rows = cursor.fetchall()
 	    return rows
	    #for(Customer_Name,Address_Line_1) in rows:
		#print Customer_Name ,Address_Line_1
    except Error as e:
        print(e)
 
    finally:
        conn.close()




def getformsdata(ResID):
    """ Connect to MySQL database """
    try:
        conn = mysql.connector.connect(host='192.168.2.7',
                                       database='AppInfo',
                                       user='applicationLogin',
                                       password='3applicationway')
        if conn.is_connected():
	    cursor = conn.cursor()
	    
	    query = "select RIF.Form_ID,VEF.Form_Name,VEF.FormURL from ReservationItemsForms RIF join ValidEquipmentForms VEF on RIF.Form_ID = VEF.ID where RIF.Reservation_ID =" +str(ResID)
            #query = "select RIF.ID, Reservation_ID,Customer_Name, Email_Address,HTML_CODE from ReservationItemsForms RIF join Customers C on RIF.Customer_ID = C.ID join ValidEquipmentForms VEF on RIF.Form_ID = VEF.ID"
	    cursor.execute(query)
            rows = cursor.fetchall()
 	    return rows
	    #for(Customer_Name,Address_Line_1) in rows:
		#print Customer_Name ,Address_Line_1
    except Error as e:
        print(e)
 
    finally:
        conn.close()




def GetReadyReservationData():
    """ Connect to MySQL database """
    try:
        conn = mysql.connector.connect(host='192.168.2.7',
                                       database='AppInfo',
                                       user='applicationLogin',
                                       password='3applicationway')
        if conn.is_connected():
	    cursor = conn.cursor()
	    
	    query = "select R.ID, C.Customer_Name, C.Email_Address, R.Rental_Date, R.Rental_End_Date from Reservations R join Customers C on R.Customer_ID = C.ID where Rental_status = 2"
            #query = "select RIF.ID, Reservation_ID,Customer_Name, Email_Address,HTML_CODE from ReservationItemsForms RIF join Customers C on RIF.Customer_ID = C.ID join ValidEquipmentForms VEF on RIF.Form_ID = VEF.ID"
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
    try:
	while True:
		print("Starting to review for emails needing to be sent")
		workingdata = GetReadyReservationData()
		for dataitem in workingdata:
		    print("Working Item...")
		    print dataitem
		    SendMail(dataitem)
		    print("Completed Item...")
		print("Completed All Items Going To Sleep...")
		time.sleep(60)
    except Error as e:
	print(e)
    