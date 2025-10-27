# Auto Cleanup for Unverified Users

## Overview
This feature automatically deletes users who have registered but have not verified their email address within a specified period (default: 7 days).

## How It Works

1. **Scheduled Task**: The cleanup runs daily at 2:00 AM via Laravel's task scheduler
2. **Target Users**: Users with a non-null `email_verification_token` who have been registered for more than 7 days (configurable)
3. **Automatic Execution**: In production, the cleanup runs without prompts
4. **Logging**: All cleanup activities are logged to the Laravel log file

## Setup Instructions

### 1. Add Crontab Entry
Add this line to your server's crontab to ensure Laravel's scheduler runs:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Replace `/path-to-your-project` with your actual project path.

Example:
```bash
* * * * * cd /var/www/vail-resort && php artisan schedule:run >> /dev/null 2>&1
```

### 2. Verify Schedule is Running
You can check if the schedule is running with:
```bash
php artisan schedule:list
```

## Manual Execution

You can manually run the cleanup command at any time:

### Default (7 days)
```bash
php artisan users:cleanup-unverified
```

### Custom Days
```bash
php artisan users:cleanup-unverified 14  # Clean up users older than 14 days
```

### Dry Run (Test Mode)
In non-production environments, the command will ask for confirmation before deletion.

## Configuration

### Change the Default Cleanup Period
Edit `routes/console.php` and modify the `--days` parameter:

```php
Schedule::command('users:cleanup-unverified --days=14')
    ->dailyAt('02:00')
    ->withoutOverlapping();
```

### Change the Cleanup Time
Modify the `dailyAt()` time:

```php
Schedule::command('users:cleanup-unverified --days=7')
    ->dailyAt('03:30')  // Run at 3:30 AM instead
    ->withoutOverlapping();
```

### Run More Frequently
```php
Schedule::command('users:cleanup-unverified --days=7')
    ->hourly()  // Run every hour
    ->withoutOverlapping();
```

## Testing

To test the cleanup feature without waiting 7 days:

1. Create a test user in the database or use an existing unverified user
2. Manually update their `created_at` timestamp to be older than your test period:
   ```sql
   UPDATE users SET created_at = DATE_SUB(NOW(), INTERVAL 8 DAY) WHERE email = 'test@example.com';
   ```
3. Run the cleanup command:
   ```bash
   php artisan users:cleanup-unverified
   ```

## Monitoring

The cleanup activity is logged in `storage/logs/laravel.log`. You can monitor it with:

```bash
tail -f storage/logs/laravel.log | grep "Unverified users cleanup"
```

## Important Notes

- ⚠️ **Irreversible**: Deleted users cannot be recovered
- ✅ **Safe**: Only deletes users with unverified emails (have `email_verification_token`)
- 📊 **Logged**: All deletions are logged for audit purposes
- 🔄 **Automatic**: Runs daily in production without user interaction
- ⏰ **Configurable**: Period and schedule time can be customized

## Troubleshooting

### Schedule Not Running
- Ensure the crontab entry is correctly configured
- Check that `php artisan schedule:list` shows the task
- Verify server timezone matches your application timezone

### Too Many Users Deleted
- Increase the `--days` parameter to give users more time
- Check registration flow to ensure emails are being sent

### No Users Being Deleted
- Verify users have `email_verification_token` set
- Check that `created_at` dates are older than the cleanup period
- Review Laravel logs for any errors

