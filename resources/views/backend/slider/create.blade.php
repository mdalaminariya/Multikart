```blade
@extends('layouts.backendmaster.master')

@section('content')

<div class="page-body">

    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="page-header">

            <div class="row">

                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Add Slider
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            Menus
                        </li>

                        <li class="breadcrumb-item active">
                            Add Slider
                        </li>

                    </ol>
                </div>

            </div>

        </div>
    </div>
    <!-- Container-fluid Ends -->


    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <div class="card">

                    <div class="card-body">

                        <div class="row product-adding">

                            <!-- LEFT SIDE : IMAGE -->
                            <div class="col-xl-5">

                                <div class="add-product">

                                    <div class="row">

                                        <!-- BIG IMAGE PREVIEW -->
                                        <div class="col-xl-9 xl-50 col-sm-6 col-9">

                                            <div class="zoom-box">

                                                <img id="Multikart"
                                                     src="{{ asset('backend/assets/images/pro3/1.jpg') }}"
                                                     alt="Slider Preview"
                                                     class="img-fluid image_zoom_1 blur-up lazyloaded">

                                            </div>

                                        </div>


                                        <!-- IMAGE UPLOAD BOX -->
                                        <div class="col-xl-3 xl-50 col-sm-6 col-3">

                                            <ul class="file-upload-product">

                                                <li>

                                                    <div class="box-input-file">

                                                        <input type="file"
                                                               name="image"
                                                               class="upload"
                                                               form="sliderForm"
                                                               onchange="previewSlider(this)"
                                                               accept="image/*"
                                                               required>

                                                        <i class="fa fa-plus"></i>

                                                    </div>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- RIGHT SIDE : FORM -->
                            <div class="col-xl-7">

                                <form id="sliderForm"
                                      class="needs-validation add-product-form"
                                      action="{{ route('admin.sliders.store') }}"
                                      method="POST"
                                      enctype="multipart/form-data">

                                    @csrf

                                    <div class="form">


                                        <!-- TITLE -->
                                        <div class="form-group mb-3 row">

                                            <label for="title"
                                                   class="col-xl-3 col-sm-4 mb-0">
                                                Title :
                                            </label>

                                            <div class="col-xl-8 col-sm-7">

                                                <input name="title"
                                                       class="form-control"
                                                       id="title"
                                                       type="text"
                                                       placeholder="Enter slider title">

                                            </div>

                                        </div>


                                        <!-- LINK -->
                                        <div class="form-group mb-3 row">

                                            <label for="link"
                                                   class="col-xl-3 col-sm-4 mb-0">
                                                Link :
                                            </label>

                                            <div class="col-xl-8 col-sm-7">

                                                <input name="link"
                                                       class="form-control"
                                                       id="link"
                                                       type="text"
                                                       placeholder="https://example.com">

                                            </div>

                                        </div>


                                        <!-- SORT ORDER -->
                                        <div class="form-group mb-3 row">

                                            <label for="sort_order"
                                                   class="col-xl-3 col-sm-4 mb-0">
                                                Sort Order :
                                            </label>

                                            <div class="col-xl-8 col-sm-7">

                                                <input name="sort_order"
                                                       class="form-control"
                                                       id="sort_order"
                                                       type="number"
                                                       value="0"
                                                       min="0">

                                            </div>

                                        </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-sm-4">Short Description :</label>
                                                <div class="col-xl-8 col-sm-7 description-sm">
                                                    <textarea id="editor1" name="description" cols="10" rows="4" maxlength="250" data-maxlength="250" ></textarea>
                                                    <small class="text-muted">
                                                        <span id="descriptionCount">0</span>/250 characters
                                                    </small>
                                                </div>
                                            </div>


                                        <!-- STATUS -->
                                        <div class="form-group mb-3 row">

                                            <label for="status"
                                                   class="col-xl-3 col-sm-4 mb-0">
                                                Status :
                                            </label>

                                            <div class="col-xl-8 col-sm-7">

                                                <select name="status"
                                                        id="status"
                                                        class="form-control">

                                                    <option value="active">
                                                        Active
                                                    </option>

                                                    <option value="inactive">
                                                        Inactive
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- BUTTONS -->
                                        <div class="form-group row">

                                            <div class="offset-xl-3 offset-sm-4 mt-4">

                                                <button type="submit"
                                                        class="btn btn-primary">
                                                    Add
                                                </button>

                                                <a href="{{ route('admin.sliders.index') }}"
                                                   class="btn btn-light">
                                                    Discard
                                                </a>

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
    <!-- Container-fluid Ends -->

</div>

@endsection


@section('script')


{{-- Text Editor --}}
<script>
    tinymce.init({
        selector: '#editor1',

        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',

        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

        setup: function (editor) {

            const maxLength = 250;

            // Character counter
            const counter = document.createElement('div');

            counter.style.marginTop = '5px';
            counter.style.fontSize = '13px';
            counter.style.color = '#777';

            // Get plain text from editor
            function getPlainText() {
                return editor.getContent({
                    format: 'text'
                });
            }

            // Update character counter
            function updateCounter() {

                const text = getPlainText();

                counter.innerHTML =
                    text.length + '/' + maxLength + ' characters';
            }

            // TinyMCE loaded
            editor.on('init', function () {

                editor.getContainer()
                    .parentNode
                    .appendChild(counter);

                updateCounter();
            });

            // Prevent typing after 250 characters
            editor.on('keydown', function (event) {

                const text = getPlainText();

                const allowedKeys = [
                    'Backspace',
                    'Delete',
                    'ArrowLeft',
                    'ArrowRight',
                    'ArrowUp',
                    'ArrowDown',
                    'Home',
                    'End'
                ];

                // Allow keyboard shortcuts such as Ctrl+A, Ctrl+C, Ctrl+X
                if (event.ctrlKey || event.metaKey) {
                    return;
                }

                if (
                    text.length >= maxLength &&
                    !allowedKeys.includes(event.key)
                ) {
                    event.preventDefault();
                }
            });

            // Limit pasted text
            editor.on('paste', function (event) {

                const currentText = getPlainText();

                const remaining = maxLength - currentText.length;

                if (remaining <= 0) {
                    event.preventDefault();
                    return;
                }

                const clipboardText = event.clipboardData
                    ? event.clipboardData.getData('text/plain')
                    : '';

                if (clipboardText.length > remaining) {

                    event.preventDefault();

                    editor.insertContent(
                        tinymce.dom.DOMUtils.DOM.encode(
                            clipboardText.substring(0, remaining)
                        )
                    );
                }
            });

            // Keep counter updated
            editor.on('input change undo redo', function () {
                updateCounter();
            });
        }
    });
</script>


<!-- Slider Image Preview -->
<script>

    function previewSlider(input) {

        const file = input.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            const preview = document.getElementById('Multikart');

            if (preview) {
                preview.src = e.target.result;
            }

            const box = input.closest('.box-input-file');

            if (box) {

                const icon = box.querySelector('i');

                if (icon) {
                    icon.style.display = 'none';
                }

                let img = box.querySelector('img');

                if (!img) {

                    img = document.createElement('img');

                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '5px';

                    box.appendChild(img);
                }

                img.src = e.target.result;
            }

        };

        reader.readAsDataURL(file);

    }

</script>


<!-- Toast Notifications -->
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


        if (typeof feather !== 'undefined') {
            feather.replace();
        }

    });

</script>

@endsection
