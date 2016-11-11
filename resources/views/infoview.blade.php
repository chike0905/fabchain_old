@extends('layouts.app')

@section('content')
<div class="container">
  <div class="overflow-hidden border rounded">
    <div class="h2 p2 bold white bg-black">
          Unlock Geth Account
    </div>
    <div class="px1 py1">
    <div class="deploy center">
        @if($errors->has())
        <?php $error = $errors->all()?>
        <p class="red">{{$error[0]}}</p>
        @endif
        <p class="h3">Please unlock Ethereum account:<?php $user = Auth::user();echo $user->ethadd;?></p>
        <form action="/geth/unlock" method="post">
        {!! csrf_field() !!}
            <table class="col">
                <tr>
                    <th class="col-2">Password</th><td class="col-10"><input type="password" class="block field col-12" name="pass"></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">Unlock</button>
        </form>
    </div>
    </div>
  </div>
</div>
@endsection
