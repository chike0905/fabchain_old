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
        $cntabi = '[{"constant":true,"inputs":[],"name":"getmaker","outputs":[{"name":"maker","type":"address"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"}],"name":"transfar","outputs":[],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"getgcodehash","outputs":[{"name":"gcodehash","type":"string"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"getname","outputs":[{"name":"name","type":"string"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"name":"","type":"string"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"_maker","outputs":[{"name":"","type":"address"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"_gcodehash","outputs":[{"name":"","type":"string"}],"payable":false,"type":"function"},{"inputs":[{"name":"name","type":"string"},{"name":"gcodehash","type":"string"}],"type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"Transfar","type":"event"}]';
        //Get contract info
        $data = [
            "jsonrpc" => "2.0",
            "method" => "eth_call",
            "params" => [$txadd],
            "id" => 3
            ];
        //$res = \Common::PostJson($url,$data);
        return view('infoview',compact("txadd","cntadd"));
    }
}
