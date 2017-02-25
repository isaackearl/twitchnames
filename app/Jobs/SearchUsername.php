<?php

namespace App\Jobs;

use App\Notifications\UsernameIsAvailable;
use App\Username;
use Curl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SearchUsername implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $username;

    /**
     * Create a new job instance.
     *
     * @param Username $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Curl::to('https://passport.twitch.tv/usernames/' . $this->username->username)->returnResponseObject()->get();

        if ($response->status === 204) {
            $this->username->user->notify(new UsernameIsAvailable($this->username));
        }
    }
}
