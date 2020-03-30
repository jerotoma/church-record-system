@extends('layouts.app')
@section('content')
  <security-view-component
    :auth='@json(auth()->user())'
    :is-admin='@json(auth()->user()->hasRole("admin"))'
  ></security-view-component>
@endsection
