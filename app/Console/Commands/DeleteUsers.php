<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Blog;
use Illuminate\Support\Facades\Log;


class DeleteUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all users with status isDelete in  1';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       Blog::where('isDelete','1')->delete();
       Log::info('User deleted');
    }
}
