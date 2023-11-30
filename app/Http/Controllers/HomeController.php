<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getData(request $request){
        $city = $request->city;
        // $client = new Client();
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city.'&APPID=2abd3df7ff0327edfbbbe50148e5272d');
        $data = $response->json();
        return response()->json(["data" => $data]);
    }
}
