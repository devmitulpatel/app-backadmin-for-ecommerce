<?php

namespace App\Console\Commands\Installer;

use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to install laravel application';

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
     * @return int
     */
    public function handle()
    {

        $this->info('Database Migrate Process Started');
        $this->callSilent('migrate:fresh');
        $this->info('Database Migrate Process Finished');
        $this->info('Database Seeding Process Started');
        $this->callSilent('db:seed');
        $this->info('Database Seeding Process Finished');
        return 0;
    }
}
