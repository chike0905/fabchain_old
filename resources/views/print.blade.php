@extends('layouts.app')

@section('content')
<div class="container">
  <div class="overflow-hidden border rounded">
    <div class="h2 p2 bold white bg-black">
          Print
    </div>
    <div class="px1 py1">
        <p class="h3">Now Printing Object. This object info is send to Blockchain on Transaction({{ $txadd }}).</p>
    </div>
  </div>
</div>
@endsection
