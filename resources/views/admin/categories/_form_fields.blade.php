@php
    $isEdit = isset($category);
    $category = $category ?? (object)['name' => '', 'slug' => '', 'icon' => 'bi-apple', 'description' => ''];
@endphp

<form method="POST" action="{{ $isEdit ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" style="max-width:640px;">
  @csrf
  @if($isEdit) @method('PUT') @endif

  <div class="admin-form-section">
    <label class="admin-form-label">Category Name</label>
    <input type="text" name="name" class="admin-input mb-3" placeholder="e.g. Nutrition" value="{{ old('name', $category->name) }}" required>

    <label class="admin-form-label">URL Slug</label>
    <input type="text" name="slug" class="admin-input mb-3" placeholder="auto-generated-from-name" value="{{ old('slug', $category->slug) }}">

    <label class="admin-form-label">Description</label>
    <textarea name="description" class="admin-textarea mb-3" rows="2" placeholder="Shown on the category page, under the title.">{{ old('description', $category->description ?? '') }}</textarea>

    <label class="admin-form-label">Icon</label>
    <select name="icon" class="admin-select">
      @foreach(['bi-apple'=>'Apple (Nutrition)','bi-flower2'=>'Flower (Remedies)','bi-cloud-fill'=>'Cloud (Mental Health)','bi-lightning-charge-fill'=>'Lightning (Fitness)','bi-moon-stars-fill'=>'Moon (Sleep)','bi-heart-fill'=>'Heart (Heart Health)'] as $val => $label)
      <option value="{{ $val }}" @selected(old('icon', $category->icon) === $val)>{{ $label }}</option>
      @endforeach
    </select>
  </div>

  <div class="admin-save-bar" style="margin:0;">
    <a href="{{ route('admin.categories.index') }}" class="btn-admin-ghost">Cancel</a>
    <button type="submit" class="btn-admin-primary"><i class="bi bi-check2"></i> {{ $isEdit ? 'Update Category' : 'Create Category' }}</button>
  </div>
</form>
