@extends('layouts.default')
@section('content')

@include('flexible.index', ['flexible_content' => $content])

@endsection