<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectInitialitionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize:project';

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
        $this->info('Initializing The Project');

        $this->output->progressStart(10);

        $this->info('Start Migration');
        $this->call('migrate:fresh', ['--force' => true,]);
        $this->output->progressAdvance(6);

        $this->info('Permission Create');
        $this->call('permissions:create');
        $this->output->progressAdvance(2);

        $this->info('Student Role Create');
        $this->call('student:role:create');
        $this->output->progressAdvance(1);

        $this->info('Super User Role Create');
        $this->call('super:user:role:create');
        $this->output->progressAdvance(1);

        $this->output->progressFinish();
        $this->info('Project Initialization Completed');
    }
}
