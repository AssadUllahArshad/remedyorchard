@extends('admin.layouts.admin')

@section('title', 'New Category')
@section('page-title', 'New Category')
@section('page-subtitle', 'Add a new topic readers can browse.')

@section('content')
    @include('admin.categories._form_fields')
@endsection
