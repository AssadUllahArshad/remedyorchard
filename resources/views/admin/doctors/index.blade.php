@extends('admin.layouts.admin')

@section('title', 'Doctors')
@section('page-title', 'Doctors')
@section('page-subtitle', 'Manage the medical experts who write and review your articles.')

@section('content')
<div class="admin-page-actions"><a href="{{ route('admin.doctors.create') }}" class="btn-admin-primary"><i class="bi bi-plus-lg"></i> New Doctor</a></div>
<div class="row g-4">
@forelse($doctors as $doctor)
  <div class="col-md-6 col-lg-4"><article class="admin-card admin-doctor-card h-100">
    <div class="admin-card-toolbar">
      <span class="doctor-avatar-fallback">{{ $doctor->initials }}</span>
      <div class="d-flex gap-2"><a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="row-action-btn" title="Edit doctor"><i class="bi bi-pencil"></i></a>
        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Delete this doctor profile?');">@csrf @method('DELETE')<button type="submit" class="row-action-btn danger" title="Delete doctor"><i class="bi bi-trash"></i></button></form>
      </div>
    </div>
    <h3 class="admin-doctor-name">{{ $doctor->name }}</h3>
    <p class="table-row-sub mb-1">{{ $doctor->role ?: 'No title set' }}</p>
    <p class="table-row-sub mb-0">{{ $doctor->articles_count }} {{ Str::plural('article', $doctor->articles_count) }}{{ $doctor->is_active ? '' : ' · Hidden from site' }}</p>
  </article></div>
@empty
  <div class="col-12"><div class="admin-empty-state"><i class="bi bi-person-badge"></i><p>No doctors yet. Add your first medical expert.</p></div></div>
@endforelse
</div>
@endsection
