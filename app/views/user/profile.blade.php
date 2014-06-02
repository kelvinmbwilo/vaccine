@extends("layout.master")

@section("title")
<h1>
    User Profile
    <small>Manage your profile</small>
</h1>
@stop

@section("breadcumb")
<ol class="breadcrumb">
    <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Profile</li>
</ol>
@stop

@section("contents")
{{ $user->firstname }}
@stop