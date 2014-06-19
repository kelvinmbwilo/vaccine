@extends("layout.master")

@section('title')
<h1>
    Inventory
    <small>{{ Auth::user()->region->region }} Region Inventory Information </small>
</h1>
@stop
@section('contents')

@stop