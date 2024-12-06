@extends('layouts.default')
@include('components.category.category-tag')
@section('content')
    @include('flexible.index', ['flexible_content' => $acf['flexible_content']])
@endsection
