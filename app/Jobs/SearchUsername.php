<?php

namespace App\Jobs;

use App\Notifications\UsernameFound;
use App\Username;
use Carbon\Carbon;
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
            $this->username->user->notify(new UsernameFound($this->username));
            $this->username->is_available = true;
            if ($this->username->has_been_found == false) {
                $this->username->has_been_found = true;
                $this->username->found_date = Carbon::now();
            }
        } else {
            $this->username->is_available = false;
        }

        $this->username->save();
    }
}
