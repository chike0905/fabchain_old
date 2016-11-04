<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $url = "http://localhost:8545";

        //nodeInfo
        $data = [
            'id' => '1',
            'jsonrpc' => '2.0',
            'method' => 'admin_nodeInfo'
            ];
        $res = \Common::PostJson($url,$data);
        $nodeinfo = $res["res"];
        $error = $res["error"];
        if($res["res"] == false){
            return view('home',compact("nodeinfo","error"));
        }else{
            $data = [
                'id' => '1',
                'jsonrpc' => '2.0',
                'method' => 'eth_coinbase'
                ];
            $res = \Common::PostJson($url,$data);
            $coinbase = $res["res"];
            $error = $res["error"];
            return view('home',compact("nodeinfo","error","coinbase"));
        }
   }
}
