<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class GethController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //print index
    public function index(request $request){
        $url = "http://localhost:5000"//Url of Octoprint
        //コントラクトをデプロイしアドレスを入手
        //Octoprintへデータを送信
    }
}
