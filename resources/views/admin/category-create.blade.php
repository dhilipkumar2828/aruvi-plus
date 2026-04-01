@extends('layouts.admin')

@php
    $category = $category ?? null;
    $isEdit = isset($category);
    $pageTitle = $isEdit ? 'Category Management' : 'Category Management';
    $subtitle = $isEdit
        ? 'Update category details for your store catalog.'
        : 'Create a new category for your store catalog.';
    $formAction = $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store');
    $submitLabel = $isEdit ? 'Update Category' : 'Create Category';
    $statusValue = old('status', $category?->status ?? 'active');
@endphp

@section('page_title', $pageTitle)

@section('styles')
<style>
    .category-form {
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-container {
        width: 100%;
        max-width: 700px;
    }

    .section-card {
        background: #fff;
        border: 1px solid rgba(194, 24, 91, 0.08);
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        margin-bottom: 24px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px dashed rgba(194, 24, 91, 0.15);
    }

    .section-title i {
        color: var(--primary);
        font-size: 20px;
    }

    .section-title h4 {
        margin: 0;
        font-size: 18px;
        color: var(--primary-dark);
        font-weight: 600;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 22px;
    }

    .field:last-child {
        margin-bottom: 0;
    }

    .field label {
        font-size: 11px;
        color: #000000;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .field input,
    .field select {
        width: 100%;
        background: #fff;
        border: 1px solid rgba(194, 24, 91, 0.15);
        border-radius: 12px;
        padding: 12px 14px;
        color: var(--text-dark);
        font-family: inherit;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .field input:focus,
    .field select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(194, 24, 91, 0.1);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        width: 100%;
    }

    .admin-btn-primary {
        padding: 14px 35px;
        font-size: 13px;
        border-radius: 14px;
        box-shadow: 0 10px 25px rgba(194, 24, 91, 0.25);
    }

    /* File Upload Styles */
    .file-upload {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 14px;
        border: 1px solid rgba(194, 24, 91, 0.2);
        background: #fff;
        width: 100%;
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
        background: var(--icon-gradient);
        color: #fff !important;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow: 0 8px 18px rgba(194, 24, 91, 0.2);
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

    .media-preview {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-top: 12px;
    }

    .media-thumb {
        width: 76px;
        height: 76px;
        border-radius: 14px;
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
            <h3>{{ $submitLabel }}</h3>
            <p style="margin: 6px 0 0; font-size: 13px; color: #888;">{{ $subtitle }}</p>
        </div>
        <div>
            <a href="{{ route('admin.categories') }}" class="admin-btn admin-btn-ghost">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <form class="category-form" action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif
        
        <div class="form-container">
            <section class="section-card">
                <div class="section-title">
                    <h4>Category Details</h4>
                </div>
                
                <div class="field">
                    <label for="name">Category Name <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" placeholder="e.g. Statues" value="{{ old('name', $category?->name ?? '') }}" required>
                </div>

                <div class="field">
                    <label for="slug">URL Slug (Optional)</label>
                    <input id="slug" name="slug" type="text" placeholder="e.g. statues-collection" value="{{ old('slug', $category?->slug ?? '') }}">
                    <p style="font-size: 11px; color: #888; margin-top: 4px;">Auto Generate from category name</p>
                </div>

                {{-- <div class="field">
                    <label for="image">Category Image <span class="text-danger">*</span></label>
                    <div class="file-upload">
                        <input id="image" name="image" type="file" accept="image/*" {{ !$isEdit ? 'required' : '' }}>
                        <label for="image" class="file-button">Choose File</label>
                        <span id="image_name" class="file-name">No file chosen</span>
                        
                        <div class="media-preview" id="image_preview_container" style="{{ ($category && $category->image) ? '' : 'display: none;' }}; margin-top: 0; margin-left: auto;">
                            @if($category && $category->image)
                                @if(Str::startsWith($category->image, 'uploads/'))
                                    <img src="{{ asset($category->image) }}" class="media-thumb" id="preview_img" style="width: 40px; height: 40px; border-radius: 8px;">
                                @else
                                    <img src="{{ Storage::url($category->image) }}" class="media-thumb" id="preview_img" style="width: 40px; height: 40px; border-radius: 8px;">
                                @endif
                            @else
                                <img src="" class="media-thumb" id="preview_img" style="width: 40px; height: 40px; border-radius: 8px;">
                            @endif
                        </div>
                    </div>
                    
                    <p style="font-size: 11px; color: #888; margin-top: 4px;">Recommended size: 500x500px. Max size: 2MB.</p>
                </div> --}}

                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="active" @selected($statusValue === 'active')>Active</option>
                        <option value="inactive" @selected($statusValue === 'inactive')>Inactive</option>
                    </select>
                </div>
            </section>

            <div class="form-actions">
                <button type="submit" class="admin-btn admin-btn-primary">
                    {{ $submitLabel }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#name').on('input', function() {
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
                        previewContainer.style.display = 'flex';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection
