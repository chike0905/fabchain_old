<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class InfoController extends Controller
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

    public function index(request $request){
        $url = "http://localhost:8545";
        $txadd = $request->input("txadd");

        //See contract address
        $data = [
            "jsonrpc" => "2.0",
            "method" => "eth_getTransactionReceipt",
            "params" => [$txadd],
            "id" => 3
            ];
        $res = \Common::PostJson($url,$data);
        if($res["res"]["result"] === Null){
            return redirect()->back()->withErrors(['msg'=> "Transaction(".$txadd.") has not been mined or undifined."]);
        }

        //Get info from contract
        $cntadd = $res["res"]["result"]["contractAddress"];
        //暫定ABI
        $cntabi = "";
        return view('infoview',compact("objname","username"));
    }
}
