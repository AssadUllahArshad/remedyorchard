@extends('admin.layouts.admin')

@section('title', 'New Article')
@section('page-title', 'New Article')
@section('page-subtitle', 'Write and publish a new post to your blog.')

@section('content')
    @include('admin.articles._form_fields')
@endsection
