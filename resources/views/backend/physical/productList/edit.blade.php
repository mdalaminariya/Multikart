@extends('layouts.backendmaster.master')

@section('content')
  <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Edit Products
                                        <small>Multikart Admin panel</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Physical</li>
                                    <li class="breadcrumb-item active">Edit Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row product-adding">
                                        <div class="col-xl-5">
                                            <div class="add-product">
                                                <div class="row">
                                                    <div class="col-xl-9 xl-50 col-sm-6 col-9">
                                                        <div class="zoom-box">
                                                      <img id="Multikart" src="{{ $product->image ? asset('uploads/physical/products/'.$product->image) : asset('backend/assets/images/pro3/1.jpg') }}">
                                                    </div>
                                                    </div>

                                                    <div class="col-xl-3 xl-50 col-sm-6 col-3">
                                                        <ul class="file-upload-product">

                                                            {{-- MAIN IMAGE --}}
                                                            <li>
                                                                <div class="box-input-file">
                                                                    <input type="file" name="image" class="upload" form="productForm"
                                                                        onchange="previewMainBox(this)">

                                                                    <i class="fa fa-plus"></i>
                                                                </div>
                                                            </li>

                                                            {{-- NEXT 4 BOXES = MULTIPLE IMAGES --}}
                                                            @foreach($product->images as $image)
                                                            <li>
                                                                <div class="box-input-file">
                                                                    <input type="file" name="images[]" onchange="previewMultiple(this)"
                                                                        form="productForm" class="upload">

                                                                    <img src="{{ asset('uploads/physical/products/'.$image->image) }}"
                                                                        style="width:100%; height:100%; object-fit:cover; border-radius:5px;">

                                                                    <i class="fa fa-plus" style="display:none;"></i>
                                                                </div>
                                                            </li>
                                                            @endforeach

                                                            @php
                                                                $remaining = 4 - $product->images->count();
                                                            @endphp

                                                            @for($i = 0; $i < $remaining; $i++)
                                                            <li>
                                                                <div class="box-input-file">
                                                                    <input type="file" name="images[]" onchange="previewMultiple(this)"
                                                                        form="productForm" class="upload">
                                                                    <i class="fa fa-plus"></i>
                                                                </div>
                                                            </li>
                                                            @endfor

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-7">
                                            <form id="productForm" class="needs-validation add-product-form" action="{{ route('admin.product.update',$product->id) }}"
                                                method="post"enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form">

                                                     <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername"
                                                            class="col-xl-3 col-sm-4 mb-0">SubCategory :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                           <select name="subcategory_id" id="subcategory_select" class="col-xl-8 col-sm-7 form-control">
                                                            @forelse($subcategories as $subcategory)
                                                                <option value="{{ $subcategory->id }}">
                                                                    {{ $subcategory->name }}
                                                                </option>
                                                            @empty
                                                                <option disabled>No subcategories found</option>
                                                            @endforelse
                                                        </select>
                                                        </div>
                                                        <div class="invalid-feedback offset-sm-4 offset-xl-3">Please
                                                            choose Valid Code.</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Title :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="title" class="form-control" id="validationCustom01"
                                                                type="text" required="" value="{{ old('title', $product->title) }}">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Price :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="price" class="form-control" id="validationCustom02"
                                                                type="text" required="" value="{{ old('title', $product->price) }}">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Discount :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="discount" class="form-control" id="validationCustom02"
                                                                type="text" required="" value="{{ old('title', $product->discount) }}">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername"
                                                            class="col-xl-3 col-sm-4 mb-0">Product Code :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="product_code" class="form-control" id="validationCustomUsername"
                                                                type="text" required="" value="{{ old('title', $product->product_code) }}">
                                                        </div>
                                                        <div class="invalid-feedback offset-sm-4 offset-xl-3">Please
                                                            choose Valid Code.</div>
                                                    </div>
                                                </div>
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <label for="exampleFormControlSelect1"
                                                            class="col-xl-3 col-sm-4 mb-0">Select Size :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control digits" name="size">
                                                                <option value="Small" {{ old('size', $product->size) == 'Small' ? 'selected' : '' }}>Small</option>
                                                                <option value="Medium" {{ old('size', $product->size) == 'Medium' ? 'selected' : '' }}>Medium</option>
                                                                <option value="Large" {{ old('size', $product->size) == 'Large' ? 'selected' : '' }}>Large</option>
                                                                <option value="Extra Large" {{ old('size', $product->size) == 'Extra Large' ? 'selected' : '' }}>Extra Large</option>
                                                            </select>
                                                        </div>
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
                                                   <div class="form-group row">
                                                        <label class="col-xl-3 col-sm-4">Add Description :</label>
                                                        <div class="col-xl-8 col-sm-7 description-sm">
                                                            <textarea id="editor1" name="description">
                                                                {{ old('description', $product->description) }}
                                                            </textarea>
                                                        </div>
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-light">Discard</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
@endsection
@section('script')
{{-- image --}}
<script>

// =========================
// MAIN IMAGE + BIG PREVIEW
// =========================
function previewMainBox(input) {

    const file = input.files[0];
    if (!file) return;

    const box = input.closest('.box-input-file');

    const reader = new FileReader();

    reader.onload = function(e) {

        // =========================
        // BIG IMAGE PREVIEW
        // =========================
        const mainPreview = document.getElementById('Multikart');
        if (mainPreview) {
            mainPreview.src = e.target.result;
        }

        // =========================
        // BOX PREVIEW
        // =========================
        setBoxPreview(box, e.target.result);
    };

    reader.readAsDataURL(file);
}


// =========================
// MULTIPLE IMAGES PREVIEW
// =========================
function previewMultiple(input) {

    const file = input.files[0];
    if (!file) return;

    const box = input.closest('.box-input-file');

    const reader = new FileReader();

    reader.onload = function(e) {
        setBoxPreview(box, e.target.result);
    };

    reader.readAsDataURL(file);
}


// =========================
// REUSABLE BOX PREVIEW FUNCTION
// =========================
function setBoxPreview(box, src) {

    const icon = box.querySelector('i');
    if (icon) icon.style.display = 'none';

    let img = box.querySelector('img');

    if (!img) {
        img = document.createElement('img');
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '5px';
        box.appendChild(img);
    }

    img.src = src;
}

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

{{-- text editor --}}
<script>
    tinymce.init({
      selector: '#editor1',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>

  {{-- message notification --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if ($errors->any())
            Toastify({
                text: "{{ $errors->first() }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "linear-gradient(to right, #FF0112, #D21302)",
            }).showToast();
        @endif

        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast();
        @endif

        @if (session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "linear-gradient(to right, #FF0112, #D21302)",
            }).showToast();
        @endif

    });
</script>
@endsection
