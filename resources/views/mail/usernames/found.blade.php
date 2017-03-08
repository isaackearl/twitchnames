@component('mail::message')
# Hello!

The username {{ $username->username }} has recently become available.<br/>
Grab it quick before someone else does!

@component('mail::button', ['url' => $twitchUrl, 'color' => 'green'])
Go to Twitch to claim it now!
@endcomponent

If you would like emails about this username to stop, please remove this username from your saved list.

@component('mail::button', ['url' => $searchUrl])
Saved usernames
@endcomponent

Thank you for using my application.  If you get the username that you are searching for, please consider donating! https://paypal.me/isaackearl

Regards,<br>
{{ config('app.name') }}
@endcomponent
