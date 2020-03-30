@extends('layouts.app')
@section('content')
    <community-view-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
    ></community-view-component>
@endsection
