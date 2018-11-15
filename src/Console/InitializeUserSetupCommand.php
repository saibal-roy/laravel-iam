<?php

namespace LaravelIam\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

use LaravelIam\Storage\User;

class InitializeUserSetupCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-iam:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Creating admin auth...');        
        User::initializeUserSetup();
        $this->info('Created admin auth successfully.');
    }

    
}
