<?php

namespace App\Console\Commands;

use App\User;
use Config;
use Illuminate\Console\Command;

class LimitUsernames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usernames:limit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'will limit usernames to the configured limit, as well as set the max usernames to whatever the amount is a user has';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $usernameLimit = Config::get('app.username_limit');
        // for each user, count how many usernames they have set
        foreach (User::all() as $user) {
            /** @var User $user */

            $usernameCount = $user->usernames->count();

            if ($usernameCount > $usernameLimit) {
                $user->username_limit = $usernameCount;
            } else {
                $user->username_limit = $usernameLimit;
            }

            $user->save();
        }

        $this->comment('Done');
    }
}
