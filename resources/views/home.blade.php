@extends('layouts.app')

@section('content')
<div class="container">
  <div class="overflow-hidden border rounded">
    <div class="h2 p2 bold white bg-black">
          Dashboard
    </div>
    <div class="px1 py1">
    <p class="h2"><?php
      $user = Auth::user();
      echo $user->name ;?> is logged in!
    </p>
    <p>
      <?php
      if($error != Null){
        echo "</p><p>Geth is not connected.</p>";
        echo "API ERROR:".$error;
      }else{
        echo "Geth is connected.";
      }
      ?>
      <div style="word-break:break-all;">
      <table class="table-light col border rounded">
        <caption class="h3">Geth</caption>
        <tr>
            <th class="col-2">Geth version</th><td class="col-10">{{ $nodeinfo["result"]["name"] }}</td>
        </tr>
        <tr>
            <th class="col-2">Netwokok ID</th><td class="col-10">{{ $nodeinfo["result"]["protocols"]["eth"]["network"] }}</td>
        </tr>
        <tr>
            <th class="col-2">Node ID</th><td class="col-10">{{$nodeinfo["result"]["id"] }}</td>
        </tr>
        <tr>
            <th class="col-2">coinbase</th><td class="col-10">{{$coinbase["result"] }}</td>
        </tr>
        <tr>
            <th class="col-2">Eth Address</th><td class="col-10">{{$user->ethadd}}</td>
        </tr>
      </table>
      </div>
    </p>
    <div class="deploy center">
        <p class="h3">Deploy</p>
        <form action="/geth" method="post">
        {!! csrf_field() !!}
            <table class="col">
                <tr>
                    <th class="col-2">Object Name:</th><td class="col-10"><input type="text" class="block field col-12" name="objname"></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">Deoploy</button>
        </form>
    </div>
    </div>
  </div>
</div>
@endsection
