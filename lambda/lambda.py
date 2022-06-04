import json
from decimal import Decimal
import email
from email.header import decode_header
import requests
import boto3

BUCKET_NAME='yappi-mails'
s3 = boto3.resource('s3')

def get_email_body(email_messages):
    for email_message in email_messages.get_payload(decode=False):
        charset = email_message.get_content_charset()
        contentType = email_message.get_content_type()
        payload = email_message.get_payload(decode=True)
        if email_message and charset and contentType == "text/plain":
            return payload.decode(charset, errors="ignore") + "\n\n"

def get_email_header(email_message, name):
    header = ''
    if email_message[name]:
        for tup in decode_header(str(email_message[name])):
            if type(tup[0]) is bytes:
                charset = tup[1]
                if charset:
                    header += tup[0].decode(tup[1])
                else:
                    header += tup[0].decode()
            elif type(tup[0]) is str:
                header += tup[0]
    return header

def decimal_to_int(obj):
    if isinstance(obj, Decimal):
        return int(obj)

def lambda_handler(event, context):
    SES_message = event['Records'][0]['Sns']['Message']
    SES_message_json = json.loads(SES_message)
    SES_message_content = SES_message_json['content']

    email_message = email.message_from_string(SES_message_content)

    # 送信元アドレス
    email_from = get_email_header(email_message, 'From')
    # 送信時間
    email_created_at = get_email_header(email_message, 'Date')
    # 送信先アドレス
    email_to = get_email_header(email_message, 'To')
    # 件名
    email_subject = get_email_header(email_message, 'Subject')
    # 本文
    email_body = get_email_body(email_message)
    
    response = requests.post('https://mailbox.yappi.jp/api/mails', data={
        "mail_text_url": "https://example.com",
        "mail_created_at": email_created_at,
        "cc": "",
        "name": email_from[0:email_from.find('<')],
        "to_email": email_to,
        "from_email": email_from[email_from.find('<')+1:email_from.find('>')],
        "subject": email_subject,
        "body": email_body
    })
    print(response)