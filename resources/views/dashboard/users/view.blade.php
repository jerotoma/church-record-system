@extends('layouts.app')
@section('content')
    <user-view-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
    ></user-view-component>
@endsection
