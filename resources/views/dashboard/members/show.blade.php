@extends('layouts.app')
@section('content')
    <member-show-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
        :member='@json($member)'>
    </member-show-component>
@endsection
