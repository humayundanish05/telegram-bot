# Telegram Bot on Render.com

A simple Telegram bot deployed on Render.com (completely free!)

## Quick Start

### 1. Get Your Bot Token
- Open Telegram and search for `@BotFather`
- Send `/newbot` and follow instructions
- Copy the token you receive

### 2. Fork or Clone This Repo
If you're on GitHub:
- Click **Fork** to create your own copy

Or manually create the files:
- `render_bot.php` - The bot code
- `Dockerfile` - Docker configuration
- `render.yaml` - Render configuration
- `.gitignore` - Files to ignore

### 3. Update Bot Token
Edit `render.yaml` and replace:
```yaml
value: YOUR_BOT_TOKEN_HERE
```
With your actual bot token from @BotFather

### 4. Deploy to Render
1. Go to https://render.com
2. Sign up with GitHub (if not already)
3. Click **New +** → **Web Service**
4. Connect your repository
5. Click **Create Web Service**
6. Wait 2-5 minutes for deployment ⏳

### 5. Set Telegram Webhook
Once deployed, Render will give you a URL like:
`https://telegram-bot-xxx.onrender.com`

Visit this URL in your browser:
```
https://api.telegram.org/botYOUR_TOKEN/setWebhook?url=https://telegram-bot-xxx.onrender.com/render_bot.php
```

### 6. Test!
Send a message to your bot on Telegram. It should respond! 🎉

## Commands
- `/start` - Welcome message
- `/help` - Show help
- Any message - Default response

## Troubleshooting

### Bot not responding?
1. Check webhook: `https://api.telegram.org/botTOKEN/getWebhookInfo`
2. View Render logs in dashboard
3. Restart service in Render dashboard

### "Free tier suspended"?
Your service auto-suspends after 15 minutes of inactivity.
- Visit the service URL to wake it up
- Or add an uptime monitor to keep it active

## Keep Service Active (Optional)
To prevent auto-suspension, use a free uptime monitor:
- UptimeRobot.com
- Betterstack.com

Set it to ping your Render URL every 10 minutes.

## Deploy Updates
Any commits to your GitHub repo will auto-deploy to Render!

## Need Help?
- Render docs: https://render.com/docs
- Telegram Bot API: https://core.telegram.org/bots/api

Enjoy your bot! 🚀

