@extends('admin.layouts.admin')
@section('title', 'Edit Doctor')
@section('page-title', 'Edit Doctor')
@section('content')
@include('admin.doctors._form', ['doctor' => $doctor])
@endsection