<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScoreUsers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $scoreusers=ScoreUsers::all();

        return view('home')->with('scoreusers',$scoreusers);
    }
}
