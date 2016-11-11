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
        <p class="h3">Please input transaction address contain Object info</p>
        <form action="/info" method="post">
        {!! csrf_field() !!}
            <table class="col">
                <tr>
                    <th class="col-2">Transaction Adress</th><td class="col-10"><input type="text" class="block field col-12" name="txadd"></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">See info</button>
        </form>
    </div>
    </div>
  </div>
</div>
@endsection
