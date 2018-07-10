# Python code to illustrate Sending mail with attachments
# from your Gmail account 
 
# libraries to be imported
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.base import MIMEBase
from email import encoders
  
fromaddr = "noreplyntr@gmail.com"
toaddr = "uastephen@gmail.com"
msg = MIMEMultipart() 
# storing the senders email address  
msg['From'] = fromaddr
# storing the receivers email address 
msg['To'] = toaddr
 
# storing the subject 
msg['Subject'] = "NTR Reservation Information"
 
# string to store the body of the mail
body = "<!DOCTYPE html><html><head><title>Page Title</title></head><body><h1>This is a Heading</h1><p>This is a paragraph.</p></body></html>"
 
# attach the body with the msg instance
msg.attach(MIMEText(body, 'html'))
 
# open the file to be sent 
#filename = "File_name_with_extension"
#attachment = open("Path of the file", "rb")
 
# instance of MIMEBase and named as p
#p = MIMEBase('application', 'octet-stream')
 
# To change the payload into encoded form
#p.set_payload((attachment).read())
 
# encode into base64
#encoders.encode_base64(p)
  
#p.add_header('Content-Disposition', "attachment; filename= %s" % filename)
 
# attach the instance 'p' to instance 'msg'
#msg.attach(p)
 
# creates SMTP session
s = smtplib.SMTP('smtp.gmail.com', 587)
 
# start TLS for security
s.starttls()
 
# Authentication
s.login(fromaddr, "3sweptaway")
 
# Converts the Multipart msg into a string
text = msg.as_string()
 
# sending the mail
s.sendmail(fromaddr, toaddr, text)
 
# terminating the session
s.quit()