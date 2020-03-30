@extends('layouts.app')
@section('content')
    <giving-type-view-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
    ></giving-type-view-component>
@endsection
