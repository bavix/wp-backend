<?php

namespace App\Console\Commands;

use Bavix\CupKit\Client;
use Illuminate\Console\Command;

class CDNCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cdn:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a view in corundum';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * @var Client $cup
         */
        $cup = app(Client::class);
        foreach ($cup->getBuckets() as $bucket) {
            var_dump($bucket);
        }
        var_dump($cup);
        die;
        var_dump($cup->createBucket('test'));
    }

}
