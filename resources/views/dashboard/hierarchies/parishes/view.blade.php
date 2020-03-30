@extends('layouts.app')
@section('content')
    <parish-view-component
        :auth='@json(auth()->user())'
        :is-admin='@json(auth()->user()->hasRole("admin"))'
    ></parish-view-component>
@endsection
