<?php

namespace App\Console\Commands;

use App\Jobs\SearchUsername;
use App\Username;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SearchUsernames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usernames:search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for availability of all the usernames';

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
     * @return void
     */
    public function handle()
    {
        $this->comment('starting search...');
        $usernames = Username::all();

        foreach ($usernames as $username) {
            $job = (new SearchUsername($username))
                ->delay(
                    Carbon::now()
                        ->addMinutes(rand(0, 719))
                        ->addSeconds(rand(0, 59))
                );

            dispatch($job);
            $this->comment('dispatching search job for ' . $username->username);
        }

        $this->comment('Done');
    }
}
