@extends('layouts.admin')

@section('page_title', 'Blogs Management')

@section('styles')
<style>
    /* File Upload Styles from Category Page */
    .file-upload {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 14px;
        border: 1px solid rgba(0, 66, 0, 0.2);
        background: #fff;
        width: 100%;
        position: relative;
    }

    .file-upload input[type="file"] {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .file-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--primary) 0%, #ff0055 100%); /* Using brand gradient */
        color: #fff !important;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 66, 0, 0.2);
        border: none;
    }

    .file-name {
        font-size: 13px;
        color: #666;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }

    .media-thumb {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        border: 1px solid rgba(0, 66, 0, 0.15);
        object-fit: cover;
        background: rgba(252, 228, 236, 0.3);
    }
</style>
@endsection

@section('content')
<div class="content-card">
    <div class="card-header">
        <div>
            <h3>Edit Blog Post</h3>
            <p style="margin: 6px 0 0; font-size: 13px; color: var(--text-muted);">Manage article content, author, and publication status.</p>
        </div>
        <a href="{{ route('admin.blogs') }}" class="admin-btn admin-btn-ghost">
            <i class="fas fa-arrow-left"></i> Back to Blogs
        </a>
    </div>

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" style="padding: 40px;">
        @csrf
        @method('PUT')
        
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label class="admin-form-label">Article Title <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required class="admin-input">
                @error('title') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>
            
            <div class="admin-form-group">
                <label class="admin-form-label">Custom Slug (Optional)</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" class="admin-input" placeholder="e.g. benefits-of-navapashanam">
                @error('slug') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Author Name <span class="text-danger">*</span></label>
                <input type="text" name="author" value="{{ old('author', $blog->author) }}" class="admin-input" required>
                @error('author') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Publication Status <span class="text-danger">*</span></label>
                <select name="is_published" class="admin-select" required>
                    <option value="1" {{ old('is_published', $blog->is_published) ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ !old('is_published', $blog->is_published) ? 'selected' : '' }}>Draft</option>
                </select>
                @error('is_published') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Feature Image</label>
                <div class="file-upload">
                    <input id="image" name="image" type="file" accept="image/*">
                    <label for="image" class="file-button">Choose File</label>
                    <span id="image_name" class="file-name">No file chosen</span>
                    
                    <div id="image_preview_container" style="{{ $blog->image ? '' : 'display: none;' }} margin-left: auto;">
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}" id="preview_img" class="media-thumb">
                        @else
                            <img src="" id="preview_img" class="media-thumb">
                        @endif
                    </div>
                </div>
                <small class="text-muted" style="margin-top: 5px; display: block;">Leave empty to keep current image</small>
                @error('image') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Published Date <span class="text-danger">*</span></label>
                <input type="date" name="published_at" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d')) }}" class="admin-input" required>
                @error('published_at') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Excerpt / Summary <span class="text-danger">*</span></label>
                <textarea name="excerpt" rows="3" class="admin-textarea" placeholder="Brief summary of the article for list views..." required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                @error('excerpt') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Full Article Content <span class="text-danger">*</span></label>
                <textarea name="content" rows="10" class="admin-textarea" placeholder="Write your full article content here..." required>{{ old('content', $blog->content) }}</textarea>
                @error('content') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px; padding-top: 30px; border-top: 1px solid rgba(0, 66, 0, 0.1);">
            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fas fa-save"></i> Update Blog
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#title').on('input', function() {
            let name = $(this).val();
            let slug = name.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            $('#slug').val(slug);
        });

        // File Input Change Handler with Preview
        const imageInput = document.getElementById('image');
        const imageName = document.getElementById('image_name');
        const previewContainer = document.getElementById('image_preview_container');
        const previewImg = document.getElementById('preview_img');

        if (imageInput && imageName) {
            imageInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                
                // Update Filename
                imageName.textContent = file ? file.name : 'No file chosen';

                // Update Preview
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewContainer.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection
