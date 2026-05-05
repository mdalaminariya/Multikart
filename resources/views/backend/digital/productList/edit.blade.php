@extends('layouts.backendmaster.master')

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            {{ isset($product) ? 'Edit Product' : 'Add Products' }}
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM START -->
    <form action="{{ route('admin.digital.product.update', $product->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="container-fluid">
            <div class="row product-adding">

                <!-- LEFT -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>General</h5>
                        </div>

                        <div class="card-body">
                            <div class="digital-add needs-validation">

                                <!-- TITLE -->
                                <div class="form-group">
                                    <label><span>*</span> Title</label>
                                    <input name="title" class="form-control" type="text"
                                        value="{{ old('title', $product->title ?? '') }}" required>
                                </div>

                                <!-- SKU -->
                                <div class="form-group">
                                    <label><span>*</span> SKU</label>
                                    <input name="sku" class="form-control" type="text"
                                        value="{{ old('sku', $product->sku ?? '') }}" required>
                                </div>

                                <!-- CATEGORY -->
                                <div class="form-group">
                                    <label><span>*</span> Categories</label>
                                    <select name="subcategory_id" class="form-control" required>
                                        <option value="">--Select--</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ old('subcategory_id', $product->subcategory_id ?? '') == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- SUMMARY -->
                                <div class="form-group">
                                    <label>Sort Summary</label>
                                    <textarea name="short_summary">{{ old('short_summary', $product->short_summary ?? '') }}</textarea>
                                </div>

                                <!-- PRICE -->
                                <div class="form-group">
                                    <label><span>*</span> Product Price</label>
                                    <input name="price" class="form-control" type="text"
                                        value="{{ old('price', $product->price ?? '') }}" required>
                                </div>

                                <!-- STATUS -->
                                <div class="form-group">
                                    <label><span>*</span> Status</label>

                                    <div class="d-flex gap-3">
                                        <label>
                                            <input type="radio" name="status" value="1"
                                                {{ old('status', $product->status ?? '') == 'enable' ? 'checked' : '' }}>
                                            Enable
                                        </label>

                                        <label>
                                            <input type="radio" name="status" value="0"
                                                {{ old('status', $product->status ?? '') == 'disable' ? 'checked' : '' }}>
                                            Disable
                                        </label>
                                    </div>
                                </div>

                                <!-- IMAGE -->
                                <label>Product Upload</label>

                                <div class="product-upload-box" id="uploadBox">

                                    <img id="previewImage"
                                        src="{{ isset($product) && $product->images ? asset('uploads/digital/products/'.$product->images) : '' }}"
                                        style="width:100%; max-height:200px; object-fit:contain;
                                        {{ isset($product) && $product->images ? '' : 'display:none;' }} margin-bottom:10px; border-radius:8px;">

                                    <div id="uploadPlaceholder"
                                        style="text-align:center; {{ isset($product) && $product->images ? 'display:none;' : '' }}">
                                        <i class="fa fa-cloud-upload" style="font-size:40px;"></i>
                                        <h4>Click or drop image here</h4>
                                    </div>

                                    <input type="file" name="images" id="fileInput"
                                        accept="image/*"
                                        style="position:absolute; inset:0; opacity:0;">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-xl-6">

                    <!-- DESCRIPTION -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Description</h5>
                        </div>
                        <div class="card-body">
                           <textarea id="editor1" name="description">{!! old('description', $product->description) !!}</textarea>
                        </div>
                    </div>

                    <!-- COLORS -->
                    <div class="form-group">
                        <label>Product Colors</label>

                        <div id="colorWrapper" class="d-flex flex-wrap gap-2">
                            @php
                                $colors = old('colors', isset($product) && $product->colors ? explode(',', $product->colors) : ['#000000']);
                            @endphp

                            @foreach($colors as $color)
                                <div class="d-flex align-items-center color-item">
                                    <input type="color" name="colors[]" value="{{ $color }}" style="width:60px;">
                                    <button type="button" class="btn btn-danger btn-sm ms-2 removeColor">X</button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-primary btn-sm mt-2" id="addColor">
                            + Add Color
                        </button>
                    </div>

                             {{-- quantity --}}
                        <div class="form-group row mt-3">
                            <label class="col-xl-3 col-sm-4 mb-0">Total Products :</label>

                            <div class="col-xl-9 col-sm-7">
                                <div class="d-inline-flex align-items-center border rounded" style="overflow:hidden; width:120px;">

                                    <button type="button" id="minusBtn"
                                        style="border:none; background:#f5f5f5; width:35px; height:35px;">-</button>

                                    <input type="text" name="quantity" id="quantityInput"
                                        value="{{ old('quantity', $product->quantity ?? 1) }}"
                                        style="width:50px; text-align:center; border:none; outline:none;">

                                    <button type="button" id="plusBtn"
                                        style="border:none; background:#f5f5f5; width:35px; height:35px;">+</button>

                                </div>
                            </div>
                        </div>

                    <!-- META -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Meta Data</h5>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input name="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title ?? '') }}">
                            </div>
                                    <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">
                                {{ isset($product) ? 'Update' : 'Add' }}
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>
</div>

@endsection

@section('script')
        {{-- TINYMCE --}}
<script>
tinymce.init({
    selector: '#editor1'
});
</script>

{{-- DROPZONE REAL --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    let fileInput = document.getElementById("fileInput");
    let preview = document.getElementById("previewImage");
    let placeholder = document.getElementById("uploadPlaceholder");
    let box = document.getElementById("uploadBox");

 let addBtn = document.getElementById("addColor");
    let wrapper = document.getElementById("colorWrapper");

    // ADD NEW COLOR
    addBtn.addEventListener("click", function () {

        let html = `
            <div class="d-flex align-items-center mb-2 color-item">
                <input type="color" name="colors[]" value="#000000" class="form-control form-control-color" style="width:60px;">
                <button type="button" class="btn btn-danger btn-sm ms-2 removeColor">X</button>
            </div>
        `;

        wrapper.insertAdjacentHTML("beforeend", html);
    });

    // REMOVE COLOR
    wrapper.addEventListener("click", function (e) {
        if (e.target.classList.contains("removeColor")) {
            e.target.closest(".color-item").remove();
        }
    });

    // FILE SELECT (CLICK)
    fileInput.addEventListener("change", function () {
        handleFile(this.files[0]);
    });

    // DRAG OVER
    box.addEventListener("dragover", function (e) {
        e.preventDefault();
        box.style.borderColor = "#28a745";
    });

    // DRAG LEAVE
    box.addEventListener("dragleave", function () {
        box.style.borderColor = "#ccc";
    });

    // DROP FILE
    box.addEventListener("drop", function (e) {
        e.preventDefault();
        fileInput.files = e.dataTransfer.files;
        handleFile(e.dataTransfer.files[0]);
    });

    // SHOW PREVIEW FUNCTION
    function handleFile(file) {
        if (!file) return;

        let reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = "block";
            placeholder.style.display = "none";
        };
        reader.readAsDataURL(file);
    }

});

// quantity

let minus = document.getElementById("minusBtn");
let plus = document.getElementById("plusBtn");
let input = document.getElementById("quantityInput");

minus.addEventListener("click", function () {
    let value = parseInt(input.value) || 1;
    if (value > 1) input.value = value - 1;
});

plus.addEventListener("click", function () {
    let value = parseInt(input.value) || 1;
    input.value = value + 1;
});
</script>
@endsection
