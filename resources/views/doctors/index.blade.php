@extends('layouts.app')
@section('title', 'Our Doctors | Healthy Habits Hub')
@section('content')
<main class="container py-5"><h1>Our Doctors</h1><p class="lead-text">Meet the experts who write and review our health articles.</p><div class="row g-4 mt-3">
@foreach($doctors as $doctor)<div class="col-md-6 col-lg-4"><a href="{{ route('doctors.show', $doctor->slug ?: $doctor->id) }}" class="text-decoration-none"><div class="card-dark p-4"><span class="author-avatar-v2">{{ $doctor->initials }}</span><h2 class="h5 mt-3">{{ $doctor->name }}</h2><p class="excerpt mb-0">{{ $doctor->role }}</p></div></a></div>@endforeach
</div></main>
@endsection
