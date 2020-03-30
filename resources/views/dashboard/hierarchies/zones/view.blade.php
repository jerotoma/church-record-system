@extends('layouts.app')
@section('content')
    <zone-view-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
    ></zone-view-component>
@endsection
