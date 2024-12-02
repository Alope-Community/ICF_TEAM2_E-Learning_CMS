@extends('layouts.master')
@section('content')
<h1>hi</h1>
<h1>{{ Auth::user()->name }}</h1>
@endsection
