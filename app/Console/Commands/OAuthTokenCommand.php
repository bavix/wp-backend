<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;

class OAuthTokenCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean old tokens';

    /**
     * @return void
     */
    public function handle(): void
    {
        // oauth_access_tokens
        Passport::token()->newQuery()
            ->where('expires_at', '<', now()->addMonth())
            ->delete();

        Passport::token()->newQuery()
            ->where('revoked', true)
            ->delete();

        // oauth_auth_codes
        Passport::authCode()->newQuery()
            ->where('expires_at', '<', now()->addMonth())
            ->delete();

        Passport::authCode()->newQuery()
            ->where('revoked', true)
            ->delete();

        // todo: oauth_refresh_tokens
        DB::table('oauth_refresh_tokens')
            ->where('expires_at', '<', now()->addMonth())
            ->delete();

        DB::table('oauth_refresh_tokens')
            ->where('revoked', true)
            ->delete();
    }

}
