@extends('layouts.app')

@section('content')
<div class="container">
  <div class="overflow-hidden border rounded">
    <div class="h2 p2 bold white bg-black">
          Geth
    </div>
    <table class="table-light col border rounded">
      <caption class="h3">Object Info</caption>
      <tr>
          <th class="col-2">Object Name</th><td class="col-10">{{ $objname }}</td>
      </tr>
      <tr>
          <th class="col-2">User name</th><td class="col-10">{{ $username }}</td>
      </tr>
      <tr>
          <th class="col-2">User Ethereum Address</th><td class="col-10">{{ $userethadd }}</td>
      </tr>
      <tr>
          <th class="col-2">G-Code File Name</th><td class="col-10">{{ $filename }}</td>
      </tr>
      <tr>
          <th class="col-2">G-Code File Hash</th><td class="col-10">{{ $filehash }}</td>
      </tr>
      <tr>
          <th class="col-2">Gas</th><td class="col-10">{{ $gas }}</td>
      </tr>
    </table>
    <div class="center">
    <form action="/print" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="objname" value="{{ $objname }}">
        <input type="hidden" name="filehash" value="{{ $filehash }}">
        <input type="hidden" name="gas" value="{{ $gas }}">
        <input type="submit" class="btn btn-primary center" value="Print">
    </form>
    </div>
  </div>
</div>
@endsection
