@extends('layouts.app')

@section('content')
<div class="container">
  <div class="overflow-hidden border rounded">
    <div class="h2 p2 bold white bg-black">
          Contract Address
    </div>
    <div class="px1 py1">
    <div class="deploy center">
      <table class="table-light col border rounded">
        <caption class="h3">Object info</caption>
        <tr>
            <th class="col-2">Object TX</th><td class="col-10">{{ $txadd }}</td>
        </tr>
        <tr>
            <th class="col-2">Object CA</th><td class="col-10">{{ $cntadd }}</td>
        </tr>
        <tr>
            <th class="col-2">Object name</th><td class="col-10">{{ $name }}</td>
        </tr>
        <tr>
            <th class="col-2">Object maker</th><td class="col-10">{{ $maker }}</td>
        </tr>
        <tr>
            <th class="col-2">Object 3D model hash</th><td class="col-10">{{ $hash }}</td>
        </tr>
      </table>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection
