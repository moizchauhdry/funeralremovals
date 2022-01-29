<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserRequests;
use App\Provider;

class HomeController extends Controller
{
    public function getHome()
    {
        $response['providers'] = Provider::orderBy('created_at','desc')->get();
        $response['recent_pickups'] = UserRequests::orderBy('created_at','desc')->take(3)->get();
        return response()->json([
            'data' => $response, 
        ]);
    }
}
