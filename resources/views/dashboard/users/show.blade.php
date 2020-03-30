@extends('layouts.app')
@section('content')
    <user-show-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
        :user='@json($user)'>
    </user-show-component>
@endsection
