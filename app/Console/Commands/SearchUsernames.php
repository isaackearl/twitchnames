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
    protected $signature = 'usernames:search {--hours=12 : The number of hours over which to even disperse the jobs}';

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

        $usernames = Username::where('found_date', '=', null)->get();

        $hours = doubleval($this->option('hours'));
        $seconds = $hours * 3600;
        $usernameCount = count($usernames);
        $secondsPerName = intVal(round($seconds / $usernameCount));
        $secondModifier = 0;

        foreach ($usernames as $username) {
            $job = (new SearchUsername($username))
                ->delay(
                    Carbon::now()
                        ->addSeconds($secondModifier)
                );

            dispatch($job);
            $this->comment('dispatching search job for ' . $username->username);
            $secondModifier += $secondsPerName;
        }

        $this->comment('Done');
    }
}
