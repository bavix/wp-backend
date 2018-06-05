<?php

namespace App\Console\Commands;

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
        Mail::send('emails.test', ['title' => __CLASS__], function (Message $message) {
            $message->to('info@babichev.net');
            $message->subject('Testing');
            // Log::channel('slack')->critical($message->toString());
        });

        return 'success!';
    }

}
