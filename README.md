# SimpleTelgramBotWebhook
This is a (very very) Simple Telegram Bot Webhook Example in PHP. It just extracts the message text and reply sender the same text. 

To use this, you should follow the following steps:

## Create a Telegram Bot
Say hello to *BotFather* and create a boy! Contact @BotFather in telegram and say:

```
/newbot
```
and follow the wizard. In the end, you will have a bot created and a secret token which you can use to access the bot.
(the [BOT_KEY] constant should be saved in webhook.php).

## Prepare for secure connection
Telegrom bot webhooks should be in secure places and you should have a website enabled with HTTPS. So, you need to buy a valid SSL certificate or -the cheaper way- create a self signed SSL certificates and fortunately, Telegrom support self signed certificates.

To create a self signed SSL certificate, you can use openssl. In linux, do the following (assuming that your *WEB_HOOK_URL* is in *WEB_HOOK_DOMAIN*):

```
openssl req -newkey rsa:2048 -sha256 -nodes -keyout certificate.key -x509 \
    -days 365  -out certificate.crt -subj "/C=IT/ST=state/L=location/O=description/CN=WEB_HOOK_DOMAIN"
```

Now, with the generated the two files, you can enable SSL on your *WEB_HOOK_DOMAIN*.

## Set the Webhook

Now, upload the code into *WEB_HOOK_URL* and then, you can set the webhook. If your SSL certificate is self signed, you have to upload the certificate as well:

```
curl -F "url=WEB_HOOK_URL" -F "certificate=@certificate.crt" \
    https://api.telegram.org/bot[BOT_KEY]/setWebhook
```

## Ready to go!
Now everything is ready and you can use your Bot.
