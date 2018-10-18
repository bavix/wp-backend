<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Support\Str;

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
//        $message = new TestMail(__CLASS__);
//        $message->subject('Testing');
//        Mail::to('info@babichev.net')
//            ->queue($message);

        $user = User::whereEmail('info@babichev.net')
            ->firstOrFail();

        $user->notify(new ResetPassword(Str::random(64)));

        return 'success!';
    }

}
