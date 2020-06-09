<?php

namespace LaravelIam\Console;

use Illuminate\Console\Command;
use LaravelIam\Storage\LaravelIamUser;

class SetupRootIamUserCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-iam:setup-root';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Root Iam User';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Setting up Root Iam User...');
        LaravelIamUser::rootUserSetup();
        $this->info('Created Root Iam User successfully.');
    }
}
