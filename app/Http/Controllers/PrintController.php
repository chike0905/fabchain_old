<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //print index
    public function index(request $request){
        //コントラクトをデプロイしアドレスを入手
        $url = "http://localhost:8545";//Url of Geth
        $user = \Auth::user();
        //暫定コントラクト
        $src = "6060604052604051610465380380610465833981016040528080518201919060200180519060200190919050505b8160006000509080519060200190828054600181600116156101000203166002900490600052602060002090601f016020900481019282601f1061007c57805160ff19168380011785556100ad565b828001600101855582156100ad579182015b828111156100ac57825182600050559160200191906001019061008e565b5b5090506100d891906100ba565b808211156100d457600081815060009055506001016100ba565b5090565b50508060016000508190555033600260006101000a81548173ffffffffffffffffffffffffffffffffffffffff02191690836c010000000000000000000000009081020402179055505b5050610333806101326000396000f360606040526000357c010000000000000000000000000000000000000000000000000000000090048063669475b71461005d5780639def48cc14610085578063d28d8852146100ab578063fc2e9e7b1461012b57610058565b610002565b346100025761006f6004805050610169565b6040518082815260200191505060405180910390f35b34610002576100a96004808035906020019091908035906020019091905050610172565b005b34610002576100bd600480505061026c565b60405180806020018281038252838181518152602001915080519060200190808383829060006004602084601f0104600302600f01f150905090810190601f16801561011d5780820380516001836020036101000a031916815260200191505b509250505060405180910390f35b346100025761013d600480505061030d565b604051808273ffffffffffffffffffffffffffffffffffffffff16815260200191505060405180910390f35b60016000505481565b600260009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff1614156101cd57610002565b80600260006101000a81548173ffffffffffffffffffffffffffffffffffffffff02191690836c010000000000000000000000009081020402179055508073ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff167fb8e15bb5c036ea8c39fd4d792b5580bfd5934d7a2171b937e560a9abc34f7a1460405180905060405180910390a35b5050565b60006000508054600181600116156101000203166002900480601f0160208091040260200160405190810160405280929190818152602001828054600181600116156101000203166002900480156103055780601f106102da57610100808354040283529160200191610305565b820191906000526020600020905b8154815290600101906020018083116102e857829003601f168201915b505050505081565b600260009054906101000a900473ffffffffffffffffffffffffffffffffffffffff168156";//compile済みコントラクトコード
        $data = [
            'id' => '2',
            'jsonrpc' => '2.0',
            'method' => 'eth_sendTransaction',
            'params' => [[
                'from' => $user->ethadd,
                'data' => $src,
                'gas' => $request->input("gas")
                ]]
            ];
        $res = \Common::PostJson($url,$data);
        if (array_key_exists("error",$res["res"])){
            if($res["res"]["error"]["message"] == "account is locked"){
                return redirect()->action("GethController@unlock");
            }
            return redirect()->action('HomeController@index')->withErrors(["msg"=>$res["res"]["error"]["message"]]);
        }
        $txadd = $res["res"]["result"];
        return view("print",compact("txadd"));
        //Octoprintへデータを送信
        $url = "http://localhost:5000";//Url of Octoprint
    }
}
