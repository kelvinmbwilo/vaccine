@extends("layout.master")

@section('title')
<h1>
    Inventory
    <small>{{ Auth::user()->district->district }} District Inventory Information </small>
</h1>
@stop
@section('contents')

@stop