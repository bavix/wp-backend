<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class TestCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws
     */
    public function handle()
    {
        $drive = Storage::disk('cdn');
        $uuid = Uuid::uuid4()->toString();
        var_dump($uuid);

//        var_dump($drive->delete('brands.1d9d1147-ba33-49af-bd35-5709e457101f'));
//        var_dump($drive->delete('brands.0e6b9566-3a65-4a6f-8cc4-7454a652787a'));
//        var_dump($drive->delete('brands.9bbf523f-8c58-43c4-a853-59a1da5b39b3'));

        $data = $drive->writeStream('brands.' . $uuid, fopen('https://babichev.net/images/3/3/optimal.png', 'rb'));
        var_dump($data);
    }

}
