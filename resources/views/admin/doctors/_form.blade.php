@php($isEdit = isset($doctor))
@php($doctor = $doctor ?? new \App\Models\Author(['is_active' => true]))
<form method="POST" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.doctors.update', $doctor->id) : route('admin.doctors.store') }}">
@csrf @if($isEdit) @method('PUT') @endif
<div class="admin-doctor-form-grid">
  <section class="admin-form-section">
    <h3>Profile</h3>
    <label class="admin-form-label">Full Name</label><input name="name" class="admin-input mb-3" value="{{ old('name', $doctor->name) }}" required>
    <div class="row g-3 mb-3"><div class="col-md-6"><label class="admin-form-label">Role</label><input name="role" class="admin-input" value="{{ old('role', $doctor->role) }}"></div><div class="col-md-6"><label class="admin-form-label">Specialty</label><input name="specialty" class="admin-input" value="{{ old('specialty', $doctor->specialty) }}"></div></div>
    <label class="admin-form-label">Qualifications</label><input name="qualifications" class="admin-input mb-3" value="{{ old('qualifications', $doctor->qualifications) }}">
    <label class="admin-form-label">Years of Experience</label><input type="number" name="experience_years" class="admin-input mb-3" min="0" max="80" value="{{ old('experience_years', $doctor->experience_years) }}">
    <label class="admin-form-label">Short Bio</label><textarea name="bio" class="admin-textarea mb-3" rows="5">{{ old('bio', $doctor->bio) }}</textarea>
    <label class="admin-form-label">Education &amp; Credentials</label><textarea name="education" class="admin-textarea" rows="4">{{ old('education', $doctor->education) }}</textarea>
  </section>
  <aside>
    <section class="admin-form-section">
      <h3>Visibility</h3>
      <label class="admin-form-label">URL Slug</label><input name="slug" class="admin-input mb-3" value="{{ old('slug', $doctor->slug) }}">
      <label class="admin-form-label">Photo</label><input type="file" name="avatar" class="admin-input mb-3" accept="image/*">
      <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $doctor->is_active))><label class="form-check-label">Show on public site</label></div>
    </section>
    <button class="btn-admin-primary admin-form-submit"><i class="bi bi-check2"></i> {{ $isEdit ? 'Save Changes' : 'Create Doctor' }}</button>
  </aside>
</div>
</form>
