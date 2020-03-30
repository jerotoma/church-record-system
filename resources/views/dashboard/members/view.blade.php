@extends('layouts.app')
@section('content')
    <member-view-component
    :auth='@json(auth()->user())'
    :is-admin='@json(auth()->user()->hasRole("admin"))'
    ></member-view-component>
@endsection
