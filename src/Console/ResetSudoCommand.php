<?php

namespace LaravelIam\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

use LaravelIam\Storage\LaravelIamUser;

class ResetSudoCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-iam:reset-sudo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Sudo user';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Reset sudo user credentials...');        
        LaravelIamUser::resetSudoDefault();
        $this->info('Reset sudo user credentials successfully.');
    }

    
}
