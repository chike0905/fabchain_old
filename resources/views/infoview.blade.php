@extends('layouts.app')

@section('content')
<div class="container">
  <div class="overflow-hidden border rounded">
    <div class="h2 p2 bold white bg-black">
          Contract Address
    </div>
    <div class="px1 py1">
    <div class="deploy center">
        <p class="h3">Address of object info contract by the transaction({{ $txadd }}) is {{ $cntadd }}. </p>
    </div>
    </div>
  </div>
</div>
@endsection
