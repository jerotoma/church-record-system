@extends('layouts.app')
@section('content')
    <giving-view-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
    ></giving-view-component>
@endsection
