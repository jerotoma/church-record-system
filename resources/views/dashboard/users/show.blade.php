@extends('layouts.app')
@section('content')
    <user-show-component
        :user='@json($user)'>
    </user-show-component>
@endsection
