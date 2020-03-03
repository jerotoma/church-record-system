@extends('layouts.app')
@section('content')
    <parish-show-component
        :parish='@json($parish)'
    ></parish-show-component>
@endsection
