<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bx:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test space';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $progressBar1 = $this->output->createProgressBar(20);

        while ($progressBar1->getProgress() < $progressBar1->getMaxSteps()) {
            $progressBar1->advance();
            \sleep(1);
        }

        $this->output->newLine();
    }

}
