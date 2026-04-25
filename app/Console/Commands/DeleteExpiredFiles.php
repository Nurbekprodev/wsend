<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteExpiredFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = File::whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($files as $file) {
            Storage::disk('local')->delete($file->file_path);
            $file->delete();
        }

        $this->info('Expired files deleted');
    }
}
