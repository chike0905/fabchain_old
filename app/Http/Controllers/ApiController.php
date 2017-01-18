<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(request $request){
        $url = "http://localhost:8545";
        $txadd = $request->input("txadd");

        //See contract address
        $data = [
            "jsonrpc" => "2.0",
            "method" => "eth_getTransactionReceipt",
            "params" => [$txadd],
            "id" => 1
            ];
        $res = \Common::PostJson($url,$data);

        if(array_key_exists("result",$res["res"]) === false){
            return ["result is nothing",$res];
        }else if($res["res"]["result"] === Null){
            return $res;
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
            "id" => 2
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
            "id" => 4
        ];
        $res = \Common::PostJson($url,$data);
        $hashdata = str_split(ltrim(ltrim($res["res"]["result"],"0"),"x"),64);
        $hashascii = $hashdata[2].$hashdata[3];
        $hash = hex2bin($hashascii);


        return [
                "txadd" => $txadd,
                "cntadd" => $cntadd,
                "name" => $name,
                "maker" => $maker,
                "hash" => $hash
                ];
    }
}
