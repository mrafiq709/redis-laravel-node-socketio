<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SignUpController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        //echo "<pre>";
        //print_r($_POST['login']);
        //echo $request->get('login');

        //return redirect('http://localhost:3000/')->with([ 'name' => $request->get('login') ]);
    }

    public function sendMessage(){

        $redis = Redis::connection();
        $redis->publish("test-channel", "This is the title of the message");

        return "Published";
    }
}
