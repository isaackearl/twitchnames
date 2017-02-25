@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading panel-title">Twitch Username Search</div>
                    <div class="panel-body">

                        <b>What is this site about?</b>
                        <p>Recently it became possible to change your username on twitch.tv.  Unfortunately however, for many of
                        us the usernames we wish to use are not available.  This site is just a convenient way to get notified if a
                        username you wish to use ever becomes available.</p>
                        <b>Will my desired username ever become available?</b>
                        <p>I believe it will.  Twitch has said that they are releasing old justin.tv names in batches, and that other names will become available
                        if they are not used in a year.</p>
                        <b>What do I have to do?</b>
                        <p>Simply register with your email, and add a username you'd like to have, and you'll be notified if it ever becomes available!</p>
                        <b>Wow thanks! Is this free to use?</b>
                        <p>Of course, however if you wish to donate after you actually get a name you are waiting for... that would be amazing.</p> <a href="http://paypal.me/isaackearl">Donate</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
