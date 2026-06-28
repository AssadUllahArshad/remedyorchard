@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
@endpush

{{--
    NOTE FOR BACKEND INTEGRATION:
    $article    -> (optional) existing Article model when editing, null/unset when creating.
    $categories -> Category::all() for the category <select>.
    $authors    -> Author::all() (or User::role('editor')->get()) for the author <select>.

    Form posts to admin.articles.store (create) or admin.articles.update (edit) — see action below.
    The hidden #body-input textarea receives Quill's HTML output on submit via the script at
    the bottom of this file; that's the field your controller should validate + sanitize + save
    as $article->body.
--}}

@php
    $categories = $categories ?? [
        (object)['id'=>1,'name'=>'Nutrition'], (object)['id'=>2,'name'=>'Home Remedies'],
        (object)['id'=>3,'name'=>'Mental Health'], (object)['id'=>4,'name'=>'Fitness'],
        (object)['id'=>5,'name'=>'Sleep'], (object)['id'=>6,'name'=>'Heart Health'],
    ];
    $authors = $authors ?? [
        (object)['id'=>1,'name'=>'Dr. Sarah Mitchell'], (object)['id'=>2,'name'=>'Emma Rhodes, RD'],
        (object)['id'=>3,'name'=>'James Okafor, ND'], (object)['id'=>4,'name'=>'Dr. Priya Nair'],
        (object)['id'=>5,'name'=>'Carlos Mendez, CSCS'],
    ];
    $isEdit = isset($article);
    $article = $article ?? (object)[
        'title' => '', 'excerpt' => '', 'body' => '', 'category_id' => null, 'author_id' => null,
        'status' => 'draft', 'read_time' => '', 'meta_title' => '', 'meta_description' => '',
    ];
@endphp

<form method="POST" action="{{ $isEdit ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}">
  @csrf
  @if($isEdit) @method('PUT') @endif

  <div class="row g-4">
    <div class="col-lg-8">

      <div class="admin-form-section">
        <label class="admin-form-label">Article Title</label>
        <input type="text" name="title" class="admin-input mb-1" placeholder="e.g. 7 Adaptogenic Herbs That Actually Work for Stress Relief"
               value="{{ old('title', $article->title) }}" required style="font-size:1.1rem; font-weight:700;">
        <p class="admin-form-hint">This becomes the page heading and the browser tab title unless overridden in SEO settings below.</p>
      </div>

      <div class="admin-form-section">
        <h3>Content</h3>

        <label class="admin-form-label">Excerpt</label>
        <textarea name="excerpt" class="admin-textarea mb-3" rows="2" placeholder="A one or two sentence summary shown on article cards and in search results.">{{ old('excerpt', $article->excerpt) }}</textarea>

        <label class="admin-form-label">Body</label>
        <div id="quill-editor" style="background:#fff;">{!! old('body', $article->body) !!}</div>
        {{-- Hidden field Quill's HTML is synced into before submit --}}
        <textarea name="body" id="body-input" style="display:none;"></textarea>
        <p class="admin-form-hint">Use the toolbar to format text, add headings, links, and images. Sanitize this HTML server-side before saving.</p>
      </div>

      <div class="admin-form-section">
        <h3>Featured Image</h3>
        <div class="image-upload-zone">
          <i class="bi bi-cloud-arrow-up"></i>
          <p class="mb-1"><span class="upload-link">Click to upload</span> or drag and drop</p>
          <p class="admin-form-hint mb-0">Recommended size 1600×900px. JPG, PNG, or WebP, up to 5MB.</p>
          <input type="file" name="thumbnail" class="d-none">
        </div>
      </div>

      <div class="admin-form-section">
        <h3>SEO &amp; Metadata</h3>
        <label class="admin-form-label">Meta Title <span style="color:var(--text-on-light-dim); font-weight:400;">(optional — defaults to article title)</span></label>
        <input type="text" name="meta_title" class="admin-input mb-3" value="{{ old('meta_title', $article->meta_title) }}">

        <label class="admin-form-label">Meta Description</label>
        <textarea name="meta_description" class="admin-textarea" rows="2">{{ old('meta_description', $article->meta_description) }}</textarea>
      </div>

    </div>

    <div class="col-lg-4">
      <div class="admin-form-section">
        <h3>Publish</h3>

        <label class="admin-form-label">Status</label>
        <select name="status" class="admin-select mb-3">
          <option value="draft" @selected(old('status', $article->status) === 'draft')>Draft</option>
          <option value="published" @selected(old('status', $article->status) === 'published')>Published</option>
          <option value="scheduled" @selected(old('status', $article->status) === 'scheduled')>Scheduled</option>
        </select>

        <label class="admin-form-label">Publish Date</label>
        <input type="datetime-local" name="published_at" class="admin-input mb-3"
               value="{{ old('published_at', isset($article->published_at) ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d\TH:i') : '') }}">

        <label class="admin-form-label">URL Slug</label>
        <input type="text" name="slug" class="admin-input" placeholder="auto-generated-from-title" value="{{ old('slug', $article->slug ?? '') }}">
        <p class="admin-form-hint">Leave blank to auto-generate from the title.</p>
      </div>

      <div class="admin-form-section">
        <h3>Organize</h3>

        <label class="admin-form-label">Category</label>
        <select name="category_id" class="admin-select mb-3" required>
          <option value="" disabled selected>Select a category</option>
          @foreach($categories as $cat)
          <option value="{{ $cat->id }}" @selected(old('category_id', $article->category_id) == $cat->id)>{{ $cat->name }}</option>
          @endforeach
        </select>

        <label class="admin-form-label">Author</label>
        <select name="author_id" class="admin-select mb-3" required>
          <option value="" disabled selected>Select an author</option>
          @foreach($authors as $a)
          <option value="{{ $a->id }}" @selected(old('author_id', $article->author_id) == $a->id)>{{ $a->name }}</option>
          @endforeach
        </select>

        <label class="admin-form-label">Estimated Read Time</label>
        <input type="text" name="read_time" class="admin-input" placeholder="e.g. 8 min read" value="{{ old('read_time', $article->read_time) }}">
      </div>

      <div class="admin-form-section mb-0">
        <h3>Tags</h3>
        <div class="d-flex flex-wrap gap-2 mb-3">
          <span class="tag-pill-input">evidence-based <i class="bi bi-x"></i></span>
          <span class="tag-pill-input">heart-health <i class="bi bi-x"></i></span>
        </div>
        <input type="text" class="admin-input" placeholder="Type a tag and press Enter">
      </div>
    </div>
  </div>

  <div class="admin-save-bar">
    <a href="{{ route('admin.articles.index') }}" class="btn-admin-ghost">Cancel</a>
    <button type="submit" name="action" value="draft" class="btn-admin-outline">Save as Draft</button>
    <button type="submit" name="action" value="publish" class="btn-admin-primary"><i class="bi bi-check2"></i> {{ $isEdit ? 'Update Article' : 'Publish Article' }}</button>
  </div>
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
  const quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Start writing your article...',
    modules: {
      toolbar: [
        [{ header: [2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        ['blockquote', 'link', 'image'],
        ['clean']
      ]
    }
  });

  // Sync Quill's HTML into the hidden textarea Laravel will actually receive on submit.
  document.querySelector('form').addEventListener('submit', function () {
    document.querySelector('#body-input').value = quill.root.innerHTML;
  });
</script>
@endpush
