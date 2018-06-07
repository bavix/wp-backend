<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailerCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bx:mailer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test mail';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $message = new TestMail(__CLASS__);
        $message->subject('Testing');
        Mail::to('info@babichev.net')
            ->queue($message);

        return 'success!';
    }

}
