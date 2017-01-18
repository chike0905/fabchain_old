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
        $user = \Auth::user();

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
        //Get contract info
        //getname()
        $data = [
            "jsonrpc" => "2.0",
            "method" => "eth_call",
            "params" => [[
                "to" => $cntadd,
                "data" => "0xc6ea59b9"
            ],"latest"],
            "id" => 3
        ];
        $res = \Common::PostJson($url,$data);
        $namedata = str_split(ltrim(ltrim($res["res"]["result"],"0"),"x"),64);
        $name = hex2bin($namedata[2]);

        //getmaker()
        $data = [
            "jsonrpc" => "2.0",
            "method" => "eth_call",
            "params" => [[
                "to" => $cntadd,
                "data" => "0x10eeba10"
            ],"latest"],
            "id" => 3
        ];
        $res = \Common::PostJson($url,$data);
        $maker = "0x".ltrim(ltrim(ltrim($res["res"]["result"],"0"),"x"),"0");

        //getgcodehash()
        $data = [
            "jsonrpc" => "2.0",
            "method" => "eth_call",
            "params" => [[
                "to" => $cntadd,
                "data" => "0xc6d078ce"
            ],"latest"],
            "id" => 3
        ];
        $res = \Common::PostJson($url,$data);
        $hashdata = str_split(ltrim(ltrim($res["res"]["result"],"0"),"x"),64);
        $hashascii = $hashdata[2].$hashdata[3];
        $hash = hex2bin($hashascii);


        return view('infoview',compact("txadd","cntadd","name","maker","hash"));
    }
}
