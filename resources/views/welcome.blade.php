@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading panel-title">Twitch Username Search (FAQ)</div>
                    <div class="panel-body">
                        <b>What is this site about?</b>
                        <p>Recently it became possible to change your username on twitch.tv. Unfortunately however, for
                            many of us the usernames we wish to use are not available. This site is just a convenient
                            way to get
                            notified if a username you wish to use ever becomes available.</p>
                        <b>Will my desired username ever become available?</b>
                        <p>I Have NO IDEA, I am not affiliated with twitch.tv. However this site has been operating and
                            checking for thousands of usernames every day for over a year and so far Twitch.tv has released very
                            few usernames for reuse.</p>
                        <b>How many usernames has this website found so far?</b>
                        <p>{{$foundNameCount}}</p>
                        <b>What do I have to do?</b>
                        <p>Simply register with your email, and add a username you'd like to have, and you'll be
                            notified if it ever becomes available!</p>
                        <b>Can I add as many usernames as I want?</b>
                        <p>Unfortunately I've been forced to put a limit on the number of usernames each user can save.
                            I'm doing this because we don't want to overwhelm twitch.tv with requests.</p>
                        <b>What if another person wants the same username as me?</b>
                        <p>Though unlikely, it is possible if you choose a common username that another person could be
                            searching for the same username. Once notifications of availability are sent out, it is
                            first come first serve, so be sure to snatch your desired username quickly.</p>
                        <b>Any other question, or comments?</b>
                        <p>Feel free to <a href="mailto:twitch.username.checker@gmail.com">send me a message</a>. I try
                            and check and respond when I can.</p>
                        <b>Wow thanks! Is this free to use?</b>
                        <p>Of course, however if you wish to donate after you actually get a name you are waiting for...
                            that would be amazing.</p>
                        <a href="http://paypal.me/isaackearl">Donate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
