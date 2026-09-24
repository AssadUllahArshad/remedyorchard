@push('styles')
<style>
  .editor-wrap { border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden; background: #fff; }
  .editor-wrap .tox-tinymce { border: 0 !important; border-radius: 0 !important; }
  .editor-wrap .tox .tox-edit-area::before { border: 0 !important; }
  .editor-help { margin-top: 0.5rem; color: var(--text-on-light-dim); font-size: 0.82rem; line-height: 1.5; }
  .editor-help strong { color: var(--text-on-light); }
  .category-checklist { display: flex; flex-direction: column; gap: 0.35rem; max-height: 220px; overflow-y: auto; border: 1px solid #e2e8e3; border-radius: 10px; padding: 0.75rem 0.9rem; }
  .category-checklist label { display: flex; align-items: center; gap: 0.55rem; font-size: 0.9rem; cursor: pointer; margin: 0; }
  .category-checklist input { accent-color: var(--emerald-brand); width: 1rem; height: 1rem; cursor: pointer; }
  @media (max-width: 767px) { .editor-wrap .tox-tinymce { min-height: 500px; } }
</style>
@endpush

{{--
    NOTE FOR BACKEND INTEGRATION:
    $article    -> (optional) existing Article model when editing, null/unset when creating.
    $categories -> Category::all() for the category <select>.
    $authors    -> Author::all() (or User::role('editor')->get()) for the author <select>.

    Form posts to admin.articles.store (create) or admin.articles.update (edit) — see action below.
    The article-body textarea is enhanced by TinyMCE and remains the field your controller
    validates, sanitizes, and saves as $article->body.
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
        'title' => '', 'excerpt' => '', 'body' => '', 'category_id' => null, 'category_ids' => [], 'author_id' => null,
        'status' => 'draft', 'read_time' => '', 'meta_title' => '', 'meta_description' => '',
    ];
@endphp

<form id="article-form" method="POST" action="{{ $isEdit ? route('admin.articles.update', $article->slug) : route('admin.articles.store') }}" enctype="multipart/form-data">
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

        <div class="editor-wrap">
          <textarea name="body" id="article-body" rows="24">{{ old('body', $article->body) }}</textarea>
        </div>
        <p class="editor-help"><strong>Tip:</strong> Use the <strong>Table</strong> button to create tables, or <strong>Code</strong> to edit HTML directly. Images, links, headings, tables, and formatting are preserved.</p>
      </div>

      <div class="admin-form-section">
        <h3>Featured Image</h3>
        <div class="image-upload-zone" id="uploadZone" onclick="document.getElementById('thumbnailInput').click()" style="cursor:pointer;">
          <i class="bi bi-cloud-arrow-up" id="uploadIcon"></i>
          <p class="mb-1" id="uploadLabel"><span class="upload-link">Click to upload</span> or drag and drop</p>
          <p class="admin-form-hint mb-0">Recommended 1600×900px · JPG, PNG, or WebP · max 5MB</p>
          <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*" class="d-none">
        </div>
        @if($isEdit && !empty($article->thumbnail_url))
        <div class="mt-2 d-flex align-items-center gap-2">
          <img src="{{ $article->thumbnail_url }}" alt="Current thumbnail" style="height:48px;width:80px;object-fit:cover;border-radius:6px;">
          <span class="admin-form-hint">Current thumbnail (upload a new one to replace)</span>
        </div>
        @endif
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

        <label class="admin-form-label">Categories</label>
        @php($selectedCategoryIds = old('category_ids', isset($article->categories) ? $article->categories->pluck('id')->all() : array_filter([$article->category_id])))
        <div class="category-checklist mb-1">
          @foreach($categories as $cat)
          <label><input type="checkbox" name="category_ids[]" value="{{ $cat->id }}" @checked(in_array($cat->id, $selectedCategoryIds))> {{ $cat->name }}</label>
          @endforeach
        </div>
        <p class="admin-form-hint">Select one or more. The first checked category is used as the primary category.</p>

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
        <h3>Options</h3>
        <div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" name="featured" value="1"
                 id="featuredCheck" @checked(old('featured', $article->featured ?? false))>
          <label class="form-check-label" for="featuredCheck">Feature this article</label>
        </div>
        <p class="admin-form-hint">Featured articles are highlighted on the homepage hero section.</p>
      </div>
    </div>
  </div>

  <div class="admin-save-bar">
    <a href="{{ route('admin.articles.index') }}" class="btn-admin-ghost">Cancel</a>
    <button type="button" class="btn-admin-outline" onclick="setStatusAndSubmit('draft')">Save as Draft</button>
    <button type="button" class="btn-admin-primary" onclick="setStatusAndSubmit('published')"><i class="bi bi-check2"></i> {{ $isEdit ? 'Update Article' : 'Publish Article' }}</button>
  </div>
</form>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') ?: 'no-api-key' }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  const articleForm = document.getElementById('article-form');
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
  const uploadUrl = @json(route('admin.images.upload'));

  tinymce.init({
    selector: '#article-body', height: 620, menubar: 'file edit view insert format tools table', branding: false, promotion: false,
    plugins: 'advlist autolink lists link image media charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table wordcount',
    toolbar: 'undo redo | styles | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | table | blockquote code | removeformat | fullscreen',
    style_formats: [{ title: 'Paragraph', format: 'p' }, { title: 'Heading 2', format: 'h2' }, { title: 'Heading 3', format: 'h3' }, { title: 'Heading 4', format: 'h4' }, { title: 'Blockquote', format: 'blockquote' }, { title: 'Preformatted', format: 'pre' }],
    table_default_attributes: { border: '1' }, table_default_styles: { 'border-collapse': 'collapse', width: '100%' }, table_sizing_mode: 'responsive',
    table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | tablecellprops tablerowprops',
    content_style: 'body{font-family:Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;font-size:16px;line-height:1.7;color:#1f2937;padding:16px;margin:0} h2{font-size:1.65rem;margin:1.8rem 0 .8rem} h3{font-size:1.35rem;margin:1.5rem 0 .7rem} p{margin:0 0 1rem} img{max-width:100%;height:auto} table{width:100%;border-collapse:collapse;margin:1.5rem 0} th,td{border:1px solid #cbd5e1;padding:10px 12px;vertical-align:top} th{background:#f1f5f9;font-weight:700} blockquote{border-left:4px solid #28623A;margin:1.5rem 0;padding:.75rem 1rem;background:#f8faf9} pre{background:#0f172a;color:#e2e8f0;padding:1rem;border-radius:6px;overflow-x:auto} a{color:#2563eb}',
    automatic_uploads: true, images_reuse_filename: false, image_title: true, image_description: true, image_dimensions: true, image_caption: true, image_advtab: true,
    images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
      const data = new FormData(); data.append('image', blobInfo.blob(), blobInfo.filename()); if (csrfToken) data.append('_token', csrfToken);
      const xhr = new XMLHttpRequest(); xhr.open('POST', uploadUrl); if (csrfToken) xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
      xhr.upload.onprogress = event => event.lengthComputable && progress(event.loaded / event.total * 100);
      xhr.onload = () => { if (xhr.status < 200 || xhr.status >= 300) return reject('Image upload failed.'); try { const json = JSON.parse(xhr.responseText); const url = json.location || json.url; url ? resolve(url) : reject('Image URL missing.'); } catch (error) { reject('Invalid image response.'); } };
      xhr.onerror = () => reject('Image upload failed.'); xhr.send(data);
    }),
    link_target_list: [{ title: 'None', value: '' }, { title: 'New window', value: '_blank' }], paste_data_images: false, convert_urls: false,
    extended_valid_elements: 'figure[class|style],figcaption[class|style],img[src|alt|title|width|height|loading|class|style],a[href|title|target|rel|class|style],table[class|style|width|border|cellpadding|cellspacing],thead[class|style],tbody[class|style],tfoot[class|style],tr[class|style],th[class|style|scope|colspan|rowspan],td[class|style|colspan|rowspan]',
    setup: editor => { window.articleTinyMCE = editor; editor.on('change input undo redo SetContent', () => editor.save()); }
  });

  async function syncEditorBeforeSubmit() { const editor = window.articleTinyMCE || tinymce.get('article-body'); if (!editor) return; await editor.uploadImages(); editor.save(); }
  articleForm.addEventListener('submit', async event => { if (articleForm.dataset.editorReady === '1') { delete articleForm.dataset.editorReady; return; } event.preventDefault(); try { await syncEditorBeforeSubmit(); articleForm.dataset.editorReady = '1'; articleForm.submit(); } catch (error) { alert('One or more article images could not be uploaded. Please try again.'); } });
  window.setStatusAndSubmit = async status => { articleForm.querySelector('select[name="status"]').value = status; try { await syncEditorBeforeSubmit(); articleForm.dataset.editorReady = '1'; articleForm.submit(); } catch (error) { alert('The article could not be prepared for saving. Please check the editor.'); } };

  // ── Image upload zone ─────────────────────────────────────────
  const input = document.getElementById('thumbnailInput');
  const zone  = document.getElementById('uploadZone');
  const label = document.getElementById('uploadLabel');
  const icon  = document.getElementById('uploadIcon');

  input.addEventListener('change', function () {
    if (this.files && this.files[0]) {
      const name = this.files[0].name;
      label.innerHTML = '<strong>' + name + '</strong> selected';
      icon.className = 'bi bi-image-fill';
      zone.style.borderColor = 'var(--emerald-brand)';
      zone.style.background  = 'rgba(40,98,58,0.05)';
    }
  });

  // Drag-and-drop support
  zone.addEventListener('dragover',  e => { e.preventDefault(); zone.style.borderColor = 'var(--emerald-brand)'; });
  zone.addEventListener('dragleave', () => zone.style.borderColor = '');
  zone.addEventListener('drop', e => {
    e.preventDefault();
    if (e.dataTransfer.files.length) {
      input.files = e.dataTransfer.files;
      input.dispatchEvent(new Event('change'));
    }
  });

  // ── Auto-generate slug from title ────────────────────────────
  const titleInput = document.querySelector('input[name="title"]');
  const slugInput  = document.querySelector('input[name="slug"]');
  if (titleInput && slugInput) {
    titleInput.addEventListener('blur', function () {
      if (!slugInput.value) {
        slugInput.value = this.value
          .toLowerCase()
          .replace(/[^a-z0-9\s-]/g, '')
          .trim()
          .replace(/\s+/g, '-');
      }
    });
  }
</script>
@endpush
