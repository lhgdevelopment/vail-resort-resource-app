<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanupUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:cleanup-unverified {days=7 : Number of days to wait before deleting unverified users}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users who have not verified their email after a specified number of days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->argument('days');
        $cutoffDate = Carbon::now()->subDays($days);
        
        $this->info("Cleaning up unverified users older than {$days} days...");
        
        // Find users who have a verification token but haven't verified their email
        // and were created before the cutoff date
        $usersToDelete = User::whereNotNull('email_verification_token')
            ->where('created_at', '<', $cutoffDate)
            ->get();
        
        $count = $usersToDelete->count();
        
        if ($count > 0) {
            $userNames = $usersToDelete->pluck('name', 'email')->toArray();
            
            $this->info("Found {$count} unverified user(s) to delete:");
            foreach ($userNames as $email => $name) {
                $this->line("  - {$name} ({$email})");
            }
            
            // Ask for confirmation in non-production environments
            if (app()->environment() !== 'production') {
                if (!$this->confirm('Do you want to proceed with deletion?')) {
                    $this->info('Cleanup cancelled.');
                    return;
                }
            }
            
            // Delete the users
            $usersToDelete->each(function ($user) {
                $user->delete();
            });
            
            $this->info("Successfully deleted {$count} unverified user(s).");
            
            // Log the cleanup
            \Log::info("Unverified users cleanup: Deleted {$count} users older than {$days} days.");
        } else {
            $this->info('No unverified users found to delete.');
        }
        
        return 0;
    }
}
