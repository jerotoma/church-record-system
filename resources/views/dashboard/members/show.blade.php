@extends('layouts.app')
@section('content')
    <member-show-component
        :member='@json($member)'>
    </member-show-component>
@endsection
