@extends('layouts.app')

@section('content')
    <dashboard-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'>
    </dashboard-component>
@endsection

