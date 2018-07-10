#http://stackabuse.com/how-to-send-emails-with-gmail-using-python/

import smtplib

gmail_user = 'noreplyNTR@gmail.com'  
gmail_password = '3sweptaway'

sent_from = gmail_user  
to = ['uastephen@gmail.com']  
subject = 'OMG Super Important Message'  
body = 'Hey, whats up?\n\n- You'

email_text = 'hey this is a test'

try:  
    server = smtplib.SMTP_SSL('smtp.gmail.com', 465)
    server.ehlo()
    server.login(gmail_user, gmail_password)
    server.sendmail('No Reply NTR', to, email_text)
    server.close()

    print 'Email sent!'
except:  
    print 'Something went wrong...'