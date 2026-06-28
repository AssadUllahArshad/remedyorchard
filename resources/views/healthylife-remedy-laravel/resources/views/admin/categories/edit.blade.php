@extends('admin.layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')
@section('page-subtitle', 'Update "' . ($category->name ?? 'this category') . '".')

@php
    $category = $category ?? (object)['id' => 1, 'name' => 'Nutrition', 'slug' => 'nutrition', 'icon' => 'bi-apple', 'description' => 'Evidence-based articles on eating well, nutrient science, and sustainable dietary patterns.'];
@endphp

@section('content')
    @include('admin.categories._form_fields', ['category' => $category])
@endsection
