<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class SignUpController extends Controller
{
    public function index(){
        return view('chat');
    }

    public function save(Request $request){

        $user = Auth::user();
        $id = Auth::id();

        //echo "data";
        //echo "<pre>";
        //print_r($user);
        //echo "<br/>";
        //print_r($id);
        //print_r($_POST['data']);
        //echo $request->get('data');
        //exit;

        $redis = Redis::connection();
        $redis->publish("test-channel", $request->get('data'));

        // return redirect()->back();

        //return redirect('http://localhost:3000/')->with([ 'name' => $request->get('login') ]);
    }
}
