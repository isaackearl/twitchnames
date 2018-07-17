@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Twitch Username Search</div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            <p>Here you can check for the availability of a username. If it is not available you can
                                setup a daily search that will <b>notify you when it becomes available!</b></p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback"
                                 v-bind:class="{ 'has-success': hasSuccess, 'has-error': hasError }">
                                <input type="text" v-on:keyup.enter="searchNames" class="form-control"
                                       v-model="search"
                                       placeholder="Search for username and press enter...">
                                <span class="form-control-feedback"
                                      v-bind:class="{ 'glyphicon glyphicon-ok': hasSuccess, 'glyphicon glyphicon-remove': hasError, 'glyphicon glyphicon-refresh spinning': searching }"
                                      aria-hidden="true"></span>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-md-6"></div>
                        <div v-show="hasSuccess" class="col-md-12">
                            <div class="alert alert-success" role="alert">This username is already available <a
                                        href="https://www.twitch.tv/settings/profile">Go to twitch to claim it!</a>
                            </div>

                        </div>
                        {{--<div class="col-md-12">--}}
                        <div v-show="hasError" class="col-md-12">
                            <div class="alert alert-info col-md-12" role="alert">
                                <div v-for="error in errorMessages" v-text="error"></div>
                            </div>
                        </div>
                        <div v-show="showButton" class="col-md-12">
                            <button type="button" v-on:click="addToList" class="btn btn-default">Notify me when this
                                username is available
                            </button>
                        </div>
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                        <div v-show="usernameList.length > 0" class="col-md-12">
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading panel-title">Saved Usernames</div>
                                <!-- List group -->
                                <ul class="list-group">
                                    <li class="list-group-item"
                                        :class="{ 'is-success': username.is_available || username.has_been_found}"
                                        v-for="username in usernameList">
                                        <span class="col-md-11" v-if="username.is_available">@{{username.username}} is available! <a
                                                    href="https://www.twitch.tv/settings/profile">Go to twitch to claim it!</a></span>
                                        <span class="col-md-11"
                                              v-else-if="!username.is_available && username.has_been_found">Username '@{{username.username}}' found @{{ username.human_readable_found_date }}</span>
                                        <span class="col-md-11" v-else>@{{username.username}}</span>
                                        <span v-on:click="deleteUsername(username.username)"
                                              class="glyphicon glyphicon-remove btn-danger btn-xs"></span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
