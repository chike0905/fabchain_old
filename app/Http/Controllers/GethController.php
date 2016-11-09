<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class GethController extends Controller
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
    //unlock account
    public function unlock(request $request){
        $url = "http://localhost:8545";
        $user = \Auth::user();
        //deploy
        $data = [
            'id' => '2',
            'jsonrpc' => '2.0',
            'method' => 'personal_unlockAccount',
            'params' => [$user->ethadd,$request->input("pass")]
            ];
        $res = \Common::PostJson($url,$data);
        if(array_key_exists("result",$res["res"]) == true){
            return redirect()->action('HomeController@index');
        } else {
            return redirect()->back()->withErrors(['msg'=> $res["res"]["error"]["message"]]);;
        }
    }

    public function postDeploy(request $request){
        $url = "http://localhost:8545";
        $objname = $request->input('objname');
        if (!$request->hasFile('gcode')) {
            return redirect()->back()->withErrors(['msg'=> "File not uploaded."]);;
        }
        $file = $request->file('gcode');
        $filename = $file->getClientOriginalName();
        $move = $file->move('./gcodes',$filename);
        $filehash = hash_file("sha256","./gcodes/".$filename);
        $user = \Auth::user();

        $username = $user->name;
        $userethadd = $user->ethadd;
        $gas = $request->input("gas");
        return view('geth',compact("objname","username","userethadd","filename","filehash","gas"));
    }
}
