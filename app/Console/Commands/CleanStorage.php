<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanStorage extends Command
{
    // The name and signature of the console command.
    protected $signature = 'storage:clean {--disk=public : The disk to clean (default is public)}';

    // The console command description.
    protected $description = 'Delete all files in the specified storage disk';

    // Execute the console command.
    public function handle()
    {
        $disk = $this->option('disk');

        if (!in_array($disk, array_keys(config('filesystems.disks')))) {
            $this->error('The specified disk does not exist.');
            return;
        }

        if ($this->confirm('Are you sure you want to delete all files from the ' . $disk . ' disk? This action cannot be undone.')) {
            Storage::disk($disk)->delete(Storage::disk($disk)->allFiles());

            $this->info('All files have been deleted from the ' . $disk . ' disk.');
        } else {
            $this->info('Operation canceled.');
        }
    }
}
