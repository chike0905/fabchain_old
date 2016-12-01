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
        $src = "0x606060405260405161051e38038061051e83398101604052805160805190820191018160006000509080519060200190828054600181600116156101000203166002900490600052602060002090601f016020900481019282601f106100ac57805160ff19168380011785555b506100dc9291505b808211156101355760008155600101610074565b505060028054600160a060020a0319163317905550506103b5806101696000396000f35b8280016001018555821561006c579182015b8281111561006c5782518260005055916020019190600101906100be565b50508060016000509080519060200190828054600181600116156101000203166002900490600052602060002090601f016020900481019282601f1061013957805160ff19168380011785555b50610088929150610074565b5090565b82800160010185558215610129579182015b8281111561012957825182600050559160200191906001019061014b56606060405236156100615760e060020a600035046310eeba1081146100665780639def48cc1461007e578063c6d078ce146100a9578063c6ea59b914610116578063d28d885214610184578063fc2e9e7b146101e7578063ff1a92a5146101fe575b610002565b3461000257610262600254600160a060020a03165b90565b346100025761027e600435602435600254600160a060020a039081163390911614156102ee57610002565b3461000257610280604080516020818101835260008252825160018054600281831615610100026000190190911604601f810184900484028301840190955284825292939092918301828280156103765780601f1061034b57610100808354040283529160200191610376565b3461000257604080516020818101835260008083528054845160026001831615610100026000190190921691909104601f81018490048402820184019095528481526102809490928301828280156103765780601f1061034b57610100808354040283529160200191610376565b34610002576102806000805460408051602060026001851615610100026000190190941693909304601f810184900484028201840190925281815292918301828280156103ad5780601f10610382576101008083540402835291602001916103ad565b3461000257610262600254600160a060020a031681565b346100025761028060018054604080516020601f6002600019610100878916150201909516949094049384018190048102820181019092528281529291908301828280156103ad5780601f10610382576101008083540402835291602001916103ad565b60408051600160a060020a039092168252519081900360200190f35b005b60405180806020018281038252838181518152602001915080519060200190808383829060006004602084601f0104600302600f01f150905090810190601f1680156102e05780820380516001836020036101000a031916815260200191505b509250505060405180910390f35b6002805473ffffffffffffffffffffffffffffffffffffffff191682179055604051600160a060020a038083169133909116907fb8e15bb5c036ea8c39fd4d792b5580bfd5934d7a2171b937e560a9abc34f7a1490600090a35050565b820191906000526020600020905b81548152906001019060200180831161035957829003601f168201915b5050505050905061007b565b820191906000526020600020905b81548152906001019060200180831161039057829003601f168201915b50505050508156";
        $nameascii = '';
        $i = 0;
        while (($char = substr($request->input("objname"), $i++, 1)) !== false) {
            $nameascii .= sprintf('%x', ord($char));
        }
        $namelen = dechex(strlen($request->input("objname")));
        $namelen = str_pad($namelen, 64, 0, STR_PAD_LEFT);
        $nameascii = str_pad($nameascii, 64, 0, STR_PAD_RIGHT);
        $headerbite = "00000000000000000000000000000000000000000000000000000000000000400000000000000000000000000000000000000000000000000000000000000080";
        $hashlength = "0000000000000000000000000000000000000000000000000000000000000040";
        $hashascii = '';
        $i = 0;
        while (($char = substr($request->input("filehash"), $i++, 1)) !== false) {
            $hashascii .= sprintf('%x', ord($char));
        }
        $bitesrc = $src. $headerbite. $namelen. $nameascii. $hashlength. $hashascii;
        $data = [
            'id' => '2',
            'jsonrpc' => '2.0',
            'method' => 'eth_sendTransaction',
            'params' => [[
                'from' => $user->ethadd,
                'data' => $bitesrc,
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
    }
}
