# SendGrid SMTP Configuration and Domain Verification Guide

## Overview
This document provides step-by-step instructions for setting up SendGrid SMTP for email delivery in the Vail Resorts Beverage application.

## Prerequisites
- SendGrid account created by Jenny Smiles (jsmiles@marketingteam.com)
- Access to SendGrid dashboard
- Domain ownership of `vailresortsbeverage.com`
- Access to domain DNS management

## Step 1: Domain Verification in SendGrid

### 1.1 Login to SendGrid Dashboard
- URL: https://app.sendgrid.com
- Email: jsmiles@marketingteam.com (or the email used to create the account)
- Password: [Use the password provided]

### 1.2 Authenticate Your Domain
1. Navigate to **Settings** → **Sender Authentication**
2. Click **"Authenticate Your Domain"**
3. Select **"I'll set up my DNS records myself"**
4. Enter your domain: `vailresortsbeverage.com`
5. Click **"Next"**

### 1.3 Retrieve DNS Records
SendGrid will provide CNAME records. Example records will look like:
```
Host: s1._domainkey.vailresortsbeverage.com
Value: s1.domainkey.u123456.wl123.sendgrid.net

Host: s2._domainkey.vailresortsbeverage.com
Value: s2.domainkey.u123456.wl123.sendgrid.net
```

### 1.4 Add DNS Records to Your Domain
1. Login to your domain registrar (e.g., GoDaddy, Namecheap, etc.)
2. Navigate to DNS Management
3. Add the CNAME records provided by SendGrid
4. Save changes

### 1.5 Wait for Verification
- DNS propagation takes 24-48 hours
- SendGrid will automatically verify when ready
- You'll receive an email when verification is complete

## Step 2: Create SendGrid API Key

### 2.1 Generate API Key
1. Login to SendGrid Dashboard
2. Navigate to **Settings** → **API Keys**
3. Click **"Create API Key"**
4. Provide a name: `Vail Resorts Beverage Production`
5. Select permissions:
   - **Full Access** (recommended for production)
   - OR Select specific permissions:
     - Mail Send (required)
     - User Management
6. Click **"Create & View"**
7. **COPY THE API KEY IMMEDIATELY** (you won't see it again!)
   - Example: `SG.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx`

### 2.2 SendGrid SMTP Credentials
Once you have the API key, use these settings:

| Setting | Value |
|---------|-------|
| **SMTP Host** | `smtp.sendgrid.net` |
| **SMTP Port** | `587` |
| **Username** | `apikey` |
| **Password** | Your API Key from Step 2.1 |
| **Encryption** | `TLS` |
| **From Email** | `no-reply@vailresortsbeverage.com` |

## Step 3: Configure in Application

### 3.1 Access SMTP Settings Page
1. Login as Admin to the application
2. Navigate to: **Settings** → **SMTP Settings**
   - URL: `http://localhost:8000/smtp` (development)
   - URL: `https://yourdomain.com/smtp` (production)

### 3.2 Enter SendGrid Credentials
Fill in the following form fields:

```
Mail Host: smtp.sendgrid.net
Mail Port: 587
Mail Username: apikey
Mail Password: [Paste your API Key here]
Mail Encryption: TLS
Mail From: no-reply@vailresortsbeverage.com
```

### 3.3 Save Settings
- Click **"Update Settings"**
- You should see a success message

## Step 4: Test Email Delivery

### 4.1 Test User Registration
1. Register a new user account
2. Check if verification email is received
3. Verify email contains correct sender address

### 4.2 Test Password Reset
- Request password reset
4. Verify reset email is received

### 4.3 Check SendGrid Activity
1. Login to SendGrid Dashboard
2. Go to **Activity** → **Email Activity**
3. You should see sent emails appearing in real-time

## Troubleshooting

### Email Not Sending

#### Check 1: Verify API Key
- Ensure the API key was copied correctly
- No extra spaces before or after the key
- API key should start with `SG.`

#### Check 2: Verify SMTP Settings
- Confirm all fields are filled in the admin panel
- Double-check the port is `587`
- Encryption should be `TLS` (not SSL)

#### Check 3: Check SendGrid Dashboard
- Go to Activity → Email Activity
- Look for bounce or spam reports
- Check if emails are being queued

#### Check 4: Check Application Logs
```bash
tail -f storage/logs/laravel.log
```
Look for SMTP connection errors or authentication failures

### Domain Not Verified

#### Check DNS Records
```bash
dig s1._domainkey.vailresortsbeverage.com
dig s2._domainkey.vailresortsbeverage.com
```
- Both should return CNAME records
- Wait 24-48 hours if records were just added

#### Check SendGrid Dashboard
1. Go to Settings → Sender Authentication
2. Check status of domain verification
3. Look for any error messages

### "Mail Authentication Failed" Error

This usually means:
1. **Wrong API Key**: The key might have been revoked or expired
2. **Wrong Username**: Must be exactly `apikey` (not your SendGrid username)
3. **Wrong Password**: Must be the API key, not your SendGrid password

**Solution**: Generate a new API key and update the settings

## SendGrid Pricing

The chosen plan is **Starter Plan** ($20/month):
- Up to 50,000 emails per month
- Unlimited contacts
- Email API
- Dedicated IP addresses (extra cost)
- Priority support

## Important Notes

1. **API Key Security**: Never commit API keys to version control
2. **Rate Limits**: Monitor email usage to avoid hitting monthly limits
3. **From Address**: Use `no-reply@vailresortsbeverage.com` as suggested
4. **Sandbox Mode**: SendGrid has a sandbox mode for testing (limited to verified emails)
5. **Webhooks**: Consider setting up webhooks for delivery tracking (optional)

## Next Steps After Configuration

1. ✅ Configure SMTP settings in admin panel
2. ✅ Test user registration email
3. ✅ Test password reset email
4. ⏳ Wait for domain verification (24-48 hours)
5. ⏳ Verify "from" sender email works
6. ✅ Monitor SendGrid dashboard for email delivery
7. ✅ Update documentation with production credentials

## Support

- **SendGrid Support**: https://support.sendgrid.com
- **SendGrid Status**: https://status.sendgrid.com
- **Laravel Mail Documentation**: https://laravel.com/docs/mail

## Quick Reference

### Application Configuration
```php
// File: config/mail.php
'default' => env('MAIL_MAILER', 'smtp'),

'smtp' => [
    'transport' => 'smtp',
    'host' => env('MAIL_HOST', 'smtp.sendgrid.net'),
    'port' => env('MAIL_PORT', 587),
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME', 'apikey'),
    'password' => env('MAIL_PASSWORD'),
],
```

### SendGrid Settings Page
URL: `/smtp` (requires admin authentication)

### Helper Function
The application uses `configureCustomMailSettings()` from `app/Helpers/helpers.php` to load SMTP settings from the database instead of `.env` file. This allows admins to change SMTP settings without code deployment.

