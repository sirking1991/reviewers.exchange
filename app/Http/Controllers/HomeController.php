<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        return 'publisher'==Auth()->user()->type 
                    ? view('publisher.home') 
                    : view('reviewer.home');
        
    }

    public function tinymceImageUpload(Request $request)
    {
        Log::debug('tinymceImageUpload', ['request'=>$request]);
    }
}
