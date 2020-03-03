@extends('layouts.app')
@section('content')
    <zone-show-component
        :zone='@json($zone)'
    ></zone-show-component>
@endsection
