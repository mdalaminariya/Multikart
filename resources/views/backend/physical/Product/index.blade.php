@extends('layouts.backendmaster.master')

@section('content')
  <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Add Products
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
                                    <li class="breadcrumb-item active">Add Product</li>
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
                                                        <img id="Multikart" src="{{ asset('backend') }}/assets/images/pro3/1.jpg"
                                                            alt="" class="img-fluid image_zoom_1 blur-up lazyloaded">
                                                            </div>
                                                        </div>

                                                    <div class="col-xl-3 xl-50 col-sm-6 col-3">
                                                        <ul class="file-upload-product">

                                                            {{-- MAIN IMAGE --}}
                                                            <li>
                                                                <div class="box-input-file">
                                                                    <input type="file" name="image" class="upload"  form="productForm"
                                                                        onchange="previewMainBox(this)"
                                                                        required>

                                                                    <i class="fa fa-plus"></i>
                                                                </div>
                                                            </li>

                                                            {{-- NEXT 4 BOXES = MULTIPLE IMAGES --}}
                                                            @for($i = 0; $i < 4; $i++)
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
                                            <form id="productForm" class="needs-validation add-product-form" action="{{ route('admin.product.store') }}"
                                                method="post"enctype="multipart/form-data">
                                                @csrf
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
                                                                type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Brand :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="brand" class="form-control" id="validationCustom01"
                                                                type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Original Price :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="original_price" class="form-control" id="validationCustom02"
                                                                type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Price :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="price" class="form-control" id="validationCustom02"
                                                                type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Discount :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="discount" class="form-control" id="validationCustom02"
                                                                type="text" required="">
                                                        </div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustomUsername"
                                                            class="col-xl-3 col-sm-4 mb-0">Product Code :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input name="product_code" class="form-control" id="validationCustomUsername"
                                                                type="text" required="">
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
                                                            <select class="form-control digits"
                                                                id="exampleFormControlSelect1"name="size">
                                                                <option value="Small">Small</option>
                                                                <option value="Medium">Medium</option>
                                                                <option value="Large">Large</option>
                                                                <option value="Extra Large">Extra Large</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    {{-- quantitys --}}
                                                       <div class="form-group row">
                                                        <label class="col-xl-3 col-sm-4 mb-0">Total Products :</label>

                                                        <div class="col-xl-9 col-sm-7">
                                                            <div class="d-inline-flex align-items-center border rounded" style="overflow:hidden; width:120px;">

                                                                <button type="button" id="minusBtn"
                                                                    style="border:none; background:#f5f5f5; width:35px; height:35px;">-</button>

                                                                <input type="text" name="quantity" id="quantityInput"
                                                                    value="1"
                                                                    style="width:50px; text-align:center; border:none; outline:none;">

                                                                <button type="button" id="plusBtn"
                                                                    style="border:none; background:#f5f5f5; width:35px; height:35px;">+</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                      <!-- COLOR VARIANT -->
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-sm-4 mb-0">Product Colors :</label>

                                                            <div class="col-xl-8 col-sm-7">

                                                                <div class="d-flex flex-wrap align-items-center gap-2" id="colorWrapper">

                                                                    <!-- Default row -->
                                                                    <div class="d-flex align-items-center color-item">
                                                                        <input type="color" name="colors[]" value="#000000"
                                                                            class="form-control form-control-color"
                                                                            style="width:60px;">

                                                                        <button type="button"
                                                                                class="btn btn-danger btn-sm ms-2 removeColor">
                                                                            X
                                                                        </button>
                                                                    </div>

                                                                </div>

                                                                <button type="button"
                                                                        class="btn btn-primary btn-sm mt-2"
                                                                        id="addColor">
                                                                    + Add Color
                                                                </button>

                                                            </div>
                                                        </div>
                                                   <div class="form-group row">
                                                        <label class="col-xl-3 col-sm-4">Add Description :</label>
                                                        <div class="col-xl-8 col-sm-7 description-sm">
                                                            <textarea id="editor1" name="description" cols="10"
                                                                rows="4"></textarea>
                                                        </div>
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            <button type="submit" class="btn btn-primary">Add</button>
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

let addBtn = document.getElementById("addColor");
let wrapper = document.getElementById("colorWrapper");

// ADD COLOR
addBtn.addEventListener("click", function () {

    let html = `
        <div class="d-flex align-items-center color-item">
            <input type="color" name="colors[]" value="#000000"
                   class="form-control form-control-color"
                   style="width:60px;">

            <button type="button"
                    class="btn btn-danger btn-sm ms-2 removeColor">
                X
            </button>
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

//quantity

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
