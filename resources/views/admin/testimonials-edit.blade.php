@extends('layouts.admin')

@section('page_title', 'Edit Testimonial')

@section('styles')
<style>
    /* File Upload Styles from Category Page */
    .file-upload {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 14px;
        border: 1px solid rgba(194, 24, 91, 0.2);
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
        background: linear-gradient(135deg, #ff6d00 0%, #ff0055 100%); /* Using brand gradient */
        color: #fff !important;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(194, 24, 91, 0.2);
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
        border: 1px solid rgba(194, 24, 91, 0.15);
        object-fit: cover;
        background: rgba(252, 228, 236, 0.3);
    }
</style>
@endsection

@section('content')
<div class="content-card">
    <div class="card-header">
        <div>
            <h3>Edit Testimonial</h3>
            <p style="margin: 6px 0 0; font-size: 13px; color: var(--text-muted);">Update the client testimonial information.</p>
        </div>
        <a href="{{ route('admin.testimonials') }}" class="admin-btn admin-btn-ghost">
            <i class="fas fa-arrow-left"></i> Back to Testimonials
        </a>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" style="padding: 40px;">
        @csrf
        @method('PUT')
        
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px;">
            <div class="admin-form-group">
                <label class="admin-form-label">Client Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required class="admin-input" placeholder="e.g. John Doe">
                @error('name') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>
            
            <div class="admin-form-group">
                <label class="admin-form-label">Designation / Location</label>
                <input type="text" name="designation" value="{{ old('designation', $testimonial->designation) }}" class="admin-input" placeholder="e.g. CEO, New York">
                @error('designation') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Rating <span class="text-danger">*</span></label>
                <select name="rating" class="admin-select" required>
                    <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                    <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                    <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                </select>
                @error('rating') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Status <span class="text-danger">*</span></label>
                <select name="is_active" class="admin-select" required>
                    <option value="1" {{ old('is_active', $testimonial->is_active) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !old('is_active', $testimonial->is_active) ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('is_active') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Upload Image</label>
                <div class="file-upload">
                    <input id="image" name="image" type="file" accept="image/*">
                    <label for="image" class="file-button">Choose File</label>
                    <span id="image_name" class="file-name">{{ $testimonial->image ? basename($testimonial->image) : 'No file chosen' }}</span>
                    <div id="image_preview_container" style="display: {{ $testimonial->image ? 'block' : 'none' }}; margin-left: auto;">
                        <img src="{{ $testimonial->image ? asset($testimonial->image) : '' }}" id="preview_img" class="media-thumb">
                    </div>
                </div>
                @error('image') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group" style="grid-column: span 2;">
                <label class="admin-form-label">Testimonial Content <span class="text-danger">*</span></label>
                <textarea name="content" rows="6" class="admin-textarea" placeholder="Enter the client's testimonial here..." required>{{ old('content', $testimonial->content) }}</textarea>
                @error('content') <span class="text-danger" style="font-size: 13px;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px; padding-top: 30px; border-top: 1px solid rgba(194, 24, 91, 0.1);">
            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fas fa-cloud-upload-alt"></i> Update Testimonial
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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
                } else {
                    // If no file selected, but we had an image before, we might want to keep it or hide it
                    // For now, let's just keep the old preview if no new file is chosen
                    @if(!$testimonial->image)
                        previewContainer.style.display = 'none';
                    @endif
                }
            });
        }
    });
</script>
@endsection
