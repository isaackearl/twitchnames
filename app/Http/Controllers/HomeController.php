<?php

namespace App\Http\Controllers;


use App\Username;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('search');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $foundNameCount = Username::withTrashed()->whereHasBeenFound(true)->count();
        return view('welcome', ['foundNameCount' => $foundNameCount]);
    }
}
