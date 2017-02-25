<?php

namespace App\Console\Commands;

use App\Jobs\SearchUsername;
use App\Username;
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
     * @return void
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
        $this->comment('starting search...');
        $usernames = Username::all();

        foreach ($usernames as $username) {
            dispatch(new SearchUsername($username));
            $this->comment('dispatching search job for ' . $username->username);
        }

        $this->comment('Done');
    }
}
