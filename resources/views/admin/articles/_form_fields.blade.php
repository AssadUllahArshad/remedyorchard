@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
  .editor-wrap { border: 1px solid var(--admin-border, #d1d5db); border-radius: 8px; overflow: hidden; }
  .editor-wrap .ql-toolbar { border: none; border-bottom: 1px solid #d1d5db; background: #f9fafb; }
  .editor-wrap .ql-container { border: none; min-height: 380px; font-size: 0.97rem; }
  .editor-wrap .ql-editor { min-height: 380px; }
</style>
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

        {{-- Editor toolbar + HTML toggle --}}
        <div class="editor-wrap">
          {{-- Quill visual editor --}}
          <div id="quill-editor">{!! old('body', $article->body) !!}</div>

          {{-- Raw HTML source editor (hidden by default) --}}
          <textarea id="html-source"
                    style="display:none; width:100%; min-height:420px; font-family:'Courier New',monospace;
                           font-size:0.82rem; line-height:1.6; padding:1rem; border:none; resize:vertical;
                           background:#0d1f17; color:#a7f3b8; border-radius:0 0 8px 8px;"
                    spellcheck="false"
                    placeholder="Paste or write raw HTML here..."></textarea>

          {{-- Toggle button --}}
          <div style="display:flex; justify-content:flex-end; padding:6px 10px;
                      background:#1a3d25; border-radius:0 0 8px 8px; border-top:1px solid #2a5c3a;">
            <button type="button" id="htmlToggleBtn"
                    style="font-size:0.75rem; font-weight:600; color:#a7f3b8; background:none;
                           border:1px solid #3DAA62; border-radius:5px; padding:4px 12px; cursor:pointer;"
                    title="Toggle between visual editor and raw HTML">
              &lt;/&gt; HTML Source
            </button>
          </div>
        </div>

        {{-- Hidden field that is actually submitted --}}
        <textarea name="body" id="body-input" style="display:none;"></textarea>
        <p class="admin-form-hint mt-2">Use the toolbar to write and format content. Click <strong>&lt;/&gt; HTML Source</strong> to paste or edit raw HTML directly.</p>
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
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
  // ── Quill editor ──────────────────────────────────────────────
  const quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Start writing your article...',
    modules: {
      toolbar: {
        container: [
          [{ header: [2, 3, 4, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          [{ color: [] }, { background: [] }],
          [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
          [{ align: [] }],
          ['blockquote', 'code-block'],
          ['link', 'image', 'video'],
          ['clean']
        ],
        handlers: {
          image: function () {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/jpeg,image/png,image/webp,image/gif');
            input.click();
            input.addEventListener('change', async function () {
              const file = input.files[0];
              if (!file) return;
              const btn = document.querySelector('.ql-image');
              if (btn) btn.disabled = true;
              try {
                const fd = new FormData();
                fd.append('image', file);
                fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                const res  = await fetch('{{ route('admin.images.upload') }}', { method: 'POST', body: fd });
                if (!res.ok) throw new Error('Upload failed');
                const data = await res.json();
                const range = quill.getSelection(true);
                quill.insertEmbed(range.index, 'image', data.url, 'user');
                quill.setSelection(range.index + 1, 0, 'silent');
              } catch (e) {
                alert('Image upload failed. Check the file size (max 5 MB) and try again.');
              } finally {
                if (btn) btn.disabled = false;
              }
            });
          }
        }
      }
    }
  });

  // ── HTML source toggle ────────────────────────────────────────
  const htmlSource  = document.getElementById('html-source');
  const toggleBtn   = document.getElementById('htmlToggleBtn');
  const quillWrap   = document.querySelector('.ql-container');
  const quillToolbar= document.querySelector('.ql-toolbar');
  let   inHtmlMode  = false;

  toggleBtn.addEventListener('click', function () {
    inHtmlMode = !inHtmlMode;
    if (inHtmlMode) {
      // Visual → HTML: copy Quill's HTML into textarea
      htmlSource.value = quill.root.innerHTML;
      htmlSource.style.display = 'block';
      quillWrap.style.display  = 'none';
      quillToolbar.style.display = 'none';
      toggleBtn.textContent = '✎ Visual Editor';
      toggleBtn.style.color = '#fff';
    } else {
      // HTML → Visual: parse textarea HTML back into Quill
      quill.root.innerHTML = htmlSource.value;
      htmlSource.style.display  = 'none';
      quillWrap.style.display   = 'block';
      quillToolbar.style.display = 'block';
      toggleBtn.textContent = '</> HTML Source';
      toggleBtn.style.color = '#a7f3b8';
    }
  });

  // Helper: get current body HTML regardless of which mode is active
  function getBodyHtml() {
    return inHtmlMode ? htmlSource.value : quill.root.innerHTML;
  }

  // Sync into the hidden textarea on submit
  const articleForm = document.getElementById('article-form');
  articleForm.addEventListener('submit', function () {
    document.querySelector('#body-input').value = getBodyHtml();
  });

  // ── Save as Draft / Publish buttons ───────────────────────────
  function setStatusAndSubmit(status) {
    const select = articleForm.querySelector('select[name="status"]');
    if (select) select.value = status;
    document.querySelector('#body-input').value = getBodyHtml();
    articleForm.submit();
  }

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
