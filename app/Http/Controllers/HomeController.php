<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
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
        $currentDateTime = Carbon::now()->subDays(7)->format('Y-m-d');
        $sign_logs =  \App\Models\sign_log::where('date','>',$currentDateTime)->get();
        return view('home',['sign_logs'=>$sign_logs]);
    }

 
}
