@extends('layouts.admin')

@php
    $product = $product ?? null;
    $isEdit = isset($product);
    $pageTitle = $isEdit ? 'Product Management' : 'Product Management';
    $subtitle = $isEdit
        ? 'Update product details for your store catalog.'
        : 'Create and publish a new product for your store catalog.';
    $formAction = $isEdit ? route('admin.products.update', $product) : route('admin.products.store');
    $submitLabel = $isEdit ? 'Update Product' : 'Create Product';
    $categoryValue = old('product_category', $product?->category_id ?? '');
    $visibilityValue = old('product_visibility', $product?->visibility ?? 'active');
    $inventoryStatusValue = old('product_inventory_status', $product?->inventory_status ?? 'in_stock');
    $taxClassValue = old('product_tax_class', $product?->tax_class ?? 'standard');
    $featuredDefault = $isEdit ? ($product?->is_featured ?? false) : true;
    $galleryValue = old(
        'gallery_images',
        $isEdit ? (is_array($product?->gallery_images) ? implode(', ', $product?->gallery_images) : ($product?->gallery_images ?? '')) : ''
    );
@endphp

@section('page_title', $pageTitle)

@section('styles')
<style>
    .product-create-card .card-header {
        align-items: flex-start;
        gap: 20px;
    }

    .product-create-card .card-subtitle {
        margin: 6px 0 0;
        font-size: 13px;
        color: #888;
    }

    .product-form {
        padding: 30px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .section-card {
        background: #fff;
        border: 1px solid rgba(0, 66, 0, 0.12);
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .section-card.full {
        grid-column: span 2;
    }

    .section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .section-title h4 {
        margin: 0;
        font-size: 16px;
        color: var(--primary-dark);
    }

    .section-hint {
        font-size: 11px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .field label {
        font-size: 12px;
        color: #000000;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .field input,
    .field select,
    .field textarea {
        background: #fff;
        border: 1px solid rgba(0, 66, 0, 0.2);
        border-radius: 12px;
        padding: 12px 14px;
        color: var(--text-dark);
        font-family: inherit;
        transition: all 0.2s ease;
    }

    .field input:focus,
    .field select:focus,
    .field textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 66, 0, 0.1);
    }

    .help-text {
        margin-top: -4px;
        font-size: 12px;
        color: #777;
    }

    .field-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .field-inline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(255, 255, 255, 0.03);
    }

    .field-inline span {
        font-size: 12px;
        color: #000000;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .toggle {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .switch {
        position: relative;
        width: 46px;
        height: 24px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 999px;
        transition: 0.2s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .slider::before {
        position: absolute;
        content: '';
        height: 18px;
        width: 18px;
        left: 3px;
        top: 2px;
        background: #bbb;
        border-radius: 50%;
        transition: 0.2s ease;
    }

    .switch input:checked + .slider {
        background: rgba(0, 66, 0, 0.35);
        border-color: rgba(0, 66, 0, 0.6);
    }

    .switch input:checked + .slider::before {
        transform: translateX(22px);
        background: #fff;
    }

    .dropzone {
        border: 1px dashed rgba(0, 66, 0, 0.35);
        border-radius: 18px;
        padding: 22px;
        text-align: center;
        background: linear-gradient(135deg, rgba(252, 228, 236, 0.35), rgba(255, 255, 255, 0.8));
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.6);
    }

    .drop-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto;
        border-radius: 14px;
        background: rgba(0, 66, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-light);
        font-size: 20px;
    }

    .dropzone p {
        margin: 10px 0 16px;
        font-size: 13px;
        color: #888;
    }

    .file-upload {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 14px;
        border: 1px solid rgba(0, 66, 0, 0.2);
        background: #fff;
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
        box-shadow: 0 8px 18px rgba(0, 66, 0, 0.2);
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
        border: 1px solid rgba(0, 66, 0, 0.15);
        object-fit: cover;
        background: rgba(252, 228, 236, 0.3);
    }

    .media-thumb.empty {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #999;
    }

    .media-meta {
        font-size: 12px;
        color: #777;
    }

    .file-input-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
        margin-top: 16px;
    }

    .media-card {
        height: 70px;
        border-radius: 12px;
        border: 1px dashed rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 10px;
    }

    @media (max-width: 1100px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .section-card.full {
            grid-column: span 1;
        }

        .field-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .product-form {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
@endsection

@section('content')
<div class="content-card product-create-card">
    <div class="card-header">
        <div>
            <h3>{{ $submitLabel }}</h3>
            <p class="card-subtitle">{{ $subtitle }}</p>
        </div>
        <div>
            <a href="{{ route('admin.products') }}" class="admin-btn admin-btn-ghost">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
        </div>
    </div>

    <form class="product-form" action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif
        <div class="form-grid">
            <section class="section-card">
                <div class="section-title">
                    <h4>Core Details</h4>
                    <span class="section-hint">Identity</span>
                </div>
                <div class="field">
                    <label for="product_name">Product Name <span class="text-danger">*</span></label>
                    <input id="product_name" name="product_name" type="text" placeholder="Navapashanam Shivlingam" value="{{ old('product_name', $product?->name ?? '') }}" required>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_sku">SKU <span class="text-danger">*</span></label>
                        <input id="product_sku" name="product_sku" type="text" placeholder="BOG-SHV-01" value="{{ old('product_sku', $product?->sku ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="product_hsn">HSN Code <span class="text-danger">*</span></label>
                        <input id="product_hsn" name="product_hsn" type="text" placeholder="123456" value="{{ old('product_hsn', $product?->hsn ?? '') }}" required>
                    </div>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_category">Category <span class="text-danger">*</span></label>
                        <select id="product_category" name="product_category" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @selected($categoryValue == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label for="product_collection">Collection <span class="text-danger">*</span></label>
                        <input id="product_collection" name="product_collection" type="text" placeholder="Navapashanam Classics" value="{{ old('product_collection', $product?->collection ?? '') }}" required>
                    </div>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_visibility">Status</label>
                        <select id="product_visibility" name="product_visibility">
                            <option value="active" @selected($visibilityValue === 'active')>Active</option>
                            <option value="inactive" @selected($visibilityValue === 'inactive')>Inactive</option>
                        </select>
                    </div>
                </div>
            </section>

            <section class="section-card">
                <div class="section-title">
                    <h4>Pricing and Inventory</h4>
                    <span class="section-hint">Commerce</span>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_price">Price (Rs.) <span class="text-danger">*</span></label>
                        <input id="product_price" name="product_price" type="number" min="0" step="0.01" placeholder="150000" value="{{ old('product_price', $product?->price ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="product_compare">MRP (Rs.)</label>
                        <input id="product_compare" name="product_compare" type="number" min="0" step="0.01" placeholder="165000" value="{{ old('product_compare', $product?->compare_price ?? '') }}">
                    </div>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_stock">Stock Quantity <span class="text-danger">*</span></label>
                        <input id="product_stock" name="product_stock" type="number" min="0" placeholder="5" value="{{ old('product_stock', $product?->stock ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="product_low_stock">Low Stock Alert</label>
                        <input id="product_low_stock" name="product_low_stock" type="number" min="0" placeholder="2" value="{{ old('product_low_stock', $product?->low_stock ?? '') }}">
                    </div>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_inventory_status">Inventory Status <span class="text-danger">*</span></label>
                        <select id="product_inventory_status" name="product_inventory_status" required>
                            <option value="in_stock" @selected($inventoryStatusValue === 'in_stock')>In Stock</option>
                            <option value="preorder" @selected($inventoryStatusValue === 'preorder')>Preorder</option>
                            <option value="out_of_stock" @selected($inventoryStatusValue === 'out_of_stock')>Out of Stock</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="product_tax_class">Tax Class</label>
                        <select id="product_tax_class" name="product_tax_class">
                            <option value="standard" @selected($taxClassValue === 'standard')>Standard</option>
                            <option value="reduced" @selected($taxClassValue === 'reduced')>Reduced</option>
                            <option value="exempt" @selected($taxClassValue === 'exempt')>Exempt</option>
                        </select>
                    </div>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="badge_text">Badge Label</label>
                        <input id="badge_text" name="badge_text" type="text" placeholder="New / Trending / Premium" value="{{ old('badge_text', $product?->badge_text ?? '') }}">
                    </div>
                    <div class="field">
                        <label for="rating">Rating (0-5)</label>
                        <input id="rating" name="rating" type="number" step="0.1" min="0" max="5" placeholder="5.0" value="{{ old('rating', $product?->rating ?? '') }}">
                    </div>
                </div>
                <div class="field">
                    <label for="reviews_count">Reviews Count</label>
                    <input id="reviews_count" name="reviews_count" type="number" min="0" placeholder="128" value="{{ old('reviews_count', $product?->reviews_count ?? '') }}">
                </div>
                <div class="field-inline">
                    <span>Featured Product</span>
                    <label class="switch">
                        <input type="checkbox" name="is_featured" @checked(old('is_featured', $featuredDefault))>
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="field-inline" style="margin-top: 12px;">
                    <span>New Arrival</span>
                    <label class="switch">
                        <input type="checkbox" name="is_new_arrival" @checked(old('is_new_arrival', $product?->is_new_arrival ?? false))>
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="field-inline" style="margin-top: 12px;">
                    <span>Allow Backorders</span>
                    <label class="switch">
                        <input type="checkbox" name="allow_backorders" @checked(old('allow_backorders', $product?->allow_backorders ?? false))>
                        <span class="slider"></span>
                    </label>
                </div>
            </section>

            <section class="section-card full">
                <div class="section-title">
                    <h4>Description</h4>
                    <span class="section-hint">Story</span>
                </div>
                <div class="field">
                    <label for="product_summary">Short Summary</label>
                    <input id="product_summary" name="product_summary" type="text" placeholder="A sacred statue crafted with ancient Navapashanam blend." value="{{ old('product_summary', $product?->short_description ?? '') }}">
                </div>
                <div class="field">
                    <label for="product_description">Full Description</label>
                    <textarea id="product_description" name="product_description" placeholder="Share the history, benefits, and craftsmanship details.">{{ old('product_description', $product?->description ?? '') }}</textarea>
                    <div class="help-text">Highlight spiritual significance, rituals, and care guidance.</div>
                </div>
            </section>

            <section class="section-card">
                <div class="section-title">
                    <h4>Media</h4>
                    <span class="section-hint">Gallery</span>
                </div>
                <div class="field">
                    <label for="primary_image">Primary Image Path</label>
                    <input id="primary_image" name="primary_image" type="text" placeholder="images/your-image.png" value="{{ old('primary_image', $product?->primary_image ?? '') }}">
                </div>
                <div class="field">
                    <label for="primary_image_upload">Upload Primary Image <span class="text-danger">*</span></label>
                    <div class="file-upload">
                        <input id="primary_image_upload" name="primary_image_upload" type="file" accept="image/*">
                        <label for="primary_image_upload" class="file-button">Choose File</label>
                        <span id="primary_image_upload_name" class="file-name">No file chosen</span>
                    </div>
                    @if ($isEdit && $product?->primary_image)
                        <div class="media-preview">
                            <img src="{{ asset($product->primary_image) }}" alt="Current primary image" class="media-thumb">
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label for="gallery_images">Gallery Images (comma separated)</label>
                    <textarea id="gallery_images" name="gallery_images" placeholder="images/img1.png, images/img2.png">{{ $galleryValue }}</textarea>
                </div>
                @if ($isEdit && !empty($product?->gallery_images))
                    @php
                        $galleryPreview = is_array($product->gallery_images)
                            ? array_slice($product->gallery_images, 0, 3)
                            : [];
                    @endphp
                    @if (!empty($galleryPreview))
                        <div class="media-preview">
                            @foreach ($galleryPreview as $image)
                                <img src="{{ asset($image) }}" alt="Gallery image" class="media-thumb">
                            @endforeach
                            @if (count($product->gallery_images ?? []) > 3)
                                <div class="media-thumb empty">+{{ count($product->gallery_images) - 3 }} more</div>
                            @endif
                        </div>
                    @endif
                @endif
                <input id="gallery_uploads" name="gallery_uploads[]" type="file" accept="image/*" multiple class="file-input-hidden">
                <div class="file-upload" style="margin-top: 12px;">
                        <label for="gallery_uploads" class="file-button">Choose Files</label>
                        <span id="gallery_uploads_name" class="file-name">No files chosen</span>
                    </div>
            </section>

            <section class="section-card">
                <div class="section-title">
                    <h4>Shipping and Attributes</h4>
                    <span class="section-hint">Logistics</span>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_weight">Weight (kg)</label>
                        <input id="product_weight" name="product_weight" type="text" placeholder="1.8" value="{{ old('product_weight', $product?->weight ?? '') }}">
                    </div>
                    <div class="field">
                        <label for="product_dimensions">Dimensions (L x W x H cm)</label>
                        <input id="product_dimensions" name="product_dimensions" type="text" placeholder="14 x 14 x 22" value="{{ old('product_dimensions', $product?->dimensions ?? '') }}">
                    </div>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_material">Material</label>
                        <input id="product_material" name="product_material" type="text" placeholder="Navapashanam compound" value="{{ old('product_material', $product?->material ?? '') }}">
                    </div>
                    <div class="field">
                        <label for="product_origin">Origin</label>
                        <input id="product_origin" name="product_origin" type="text" placeholder="Palani Hills" value="{{ old('product_origin', $product?->origin ?? '') }}">
                    </div>
                </div>
                <div class="field">
                    <label for="product_tags">Tags</label>
                    <input id="product_tags" name="product_tags" type="text" placeholder="healing, temple, handcrafted" value="{{ old('product_tags', $product?->tags ?? '') }}">
                </div>
            </section>

            <section class="section-card full">
                <div class="section-title">
                    <h4>SEO and Visibility</h4>
                    <span class="section-hint">Search</span>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="product_meta_title">Meta Title</label>
                        <input id="product_meta_title" name="product_meta_title" type="text" placeholder="Navapashanam Shivlingam - Auvri Plus" value="{{ old('product_meta_title', $product?->meta_title ?? '') }}">
                    </div>
                    <div class="field">
                        <label for="product_slug">URL Slug</label>
                        <input id="product_slug" name="product_slug" type="text" placeholder="navapashanam-shivlingam" value="{{ old('product_slug', $product?->slug ?? '') }}">
                    </div>
                </div>
                <div class="field">
                    <label for="product_meta_description">Meta Description</label>
                    <textarea id="product_meta_description" name="product_meta_description" placeholder="Short summary for search engines.">{{ old('product_meta_description', $product?->meta_description ?? '') }}</textarea>
                </div>
            </section>
        </div>

        <div class="form-actions">
            <button type="submit" class="admin-btn admin-btn-primary">{{ $submitLabel }}</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#product_name').on('input', function() {
            let name = $(this).val();
            let slug = name.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            $('#product_slug').val(slug);
        });

        $('#product_sku').on('input', function() {
            let sku = $(this).val();
            if (sku.length > 1) {
                window.checkUnique('products', 'sku', sku, '#product_sku', {{ $product?->id ?? 'null' }});
            } else {
                $(this).css('border-color', '');
                $(this).siblings('.error-msg').hide();
            }
        });

        $('#product_slug').on('input', function() {
            let slug = $(this).val();
            if (slug.length > 1) {
                window.checkUnique('products', 'slug', slug, '#product_slug', {{ $product?->id ?? 'null' }});
            } else {
                $(this).css('border-color', '');
                $(this).siblings('.error-msg').hide();
            }
        });

        // Strict Numeric Input Validation
        $('#product_price, #product_compare, #product_stock, #product_low_stock').on('keypress', function(e) {
            let charCode = (e.which) ? e.which : e.keyCode;
            let isDot = (charCode === 46);
            let isDigit = (charCode >= 48 && charCode <= 57);
            
            // Allow dot only for price fields
            if (isDot && $(this).attr('id').includes('price')) {
                if ($(this).val().indexOf('.') !== -1) return false; // Only one dot allowed
                return true;
            }
            
            // Allow only digits
            if (!isDigit) return false;
        });

        // Prevent pasting non-numeric values
        $('#product_price, #product_compare, #product_stock, #product_low_stock').on('paste', function(e) {
            let pasteData = e.originalEvent.clipboardData.getData('text');
            let isPrice = $(this).attr('id').includes('price');
            let regex = isPrice ? /^\d*\.?\d*$/ : /^\d+$/;
            
            if (!regex.test(pasteData)) {
                e.preventDefault();
            }
        });
    });
    (function () {
        const primaryInput = document.getElementById('primary_image_upload');
        const primaryName = document.getElementById('primary_image_upload_name');
        if (primaryInput && primaryName) {
            primaryInput.addEventListener('change', function () {
                primaryName.textContent = primaryInput.files.length ? primaryInput.files[0].name : 'No file chosen';
            });
        }

        const galleryInput = document.getElementById('gallery_uploads');
        const galleryName = document.getElementById('gallery_uploads_name');
        if (galleryInput && galleryName) {
            galleryInput.addEventListener('change', function () {
                if (!galleryInput.files.length) {
                    galleryName.textContent = 'No files chosen';
                    return;
                }
                galleryName.textContent = galleryInput.files.length === 1
                    ? galleryInput.files[0].name
                    : galleryInput.files.length + ' files selected';
            });
        }
    })();

    // Clear error on input (kept for any custom handled cases if needed, but global covers it)
    $(document).on('input change', '.product-form input, .product-form select', function() {
        $(this).css('border-color', '');
        $(this).next('.error-msg').remove();
    });
</script>
@endsection
