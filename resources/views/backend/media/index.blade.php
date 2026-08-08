@extends('layouts.backendmaster.master')

@section('content')

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="page-header">

            <div class="row">

                <div class="col-lg-6">

                    <div class="page-header-left">

                        <h3>
                            Media
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

                        <li class="breadcrumb-item active">

                            Media

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>
    <!-- Container-fluid Ends-->



    <!-- Container-fluid starts-->
    <div class="container-fluid bulk-cate">

        {{-- UPLOAD CARD --}}
       <div class="card ">
    <div class="card-body">

        {{-- DROPZONE STYLE --}}
        <form class="dropzone digits"
              id="singleFileUpload"
              enctype="multipart/form-data">

            @csrf

            <div class="dz-message needsclick custom-dropzone"
                 id="dropArea">

                <i class="fa fa-cloud-upload-alt upload-icon"></i>

                <h4 class="mb-0 f-w-600">
                    Drop Files Here Or Click To Upload.
                </h4>

                {{-- HIDDEN FILE INPUT --}}
                <input type="file"
                       id="imageUpload"
                       name="image"
                       accept="image/*"
                       multiple
                       hidden>

            </div>

        </form>

    </div>
</div>



        {{-- TABLE --}}
        <div class="card">

            <div class="card-header">

                <form class="form-inline search-form search-box">

                    <div class="form-group">

                        <input class="form-control-plaintext search-input"
                               type="search"
                               placeholder="Search..">

                        <span class="d-sm-none mobile-search">

                            <i data-feather="search"></i>

                        </span>

                    </div>

                </form>

            </div>



            <div class="card-body">

                <div class="table-responsive table-desi">

                    <table class="all-package coupon-table media-table table table-striped">

                        <thead>

                            <tr>

                                <th>
                                    <button type="button" class="btn btn-danger btn-sm delete_all">
                                        Delete
                                    </button>
                                </th>

                                <th>Image</th>

                                <th>File Name</th>

                                <th>URL</th>

                            </tr>

                        </thead>



                        <tbody id="imageTableBody">

                            @forelse($media as $item)

                                <tr data-row-id="{{ $item->id }}">

                                    <td>

                                        <input class="checkbox_animated check-it row_checkbox"
                                               type="checkbox"
                                               data-id="{{ $item->id }}">

                                    </td>

                                    <td>

                                        <img src="{{ asset('uploads/media/'.$item->image) }}"
                                             alt="user"
                                             width="60"
                                             height="60"
                                             style="object-fit:cover;">

                                    </td>

                                    <td>

                                        {{ $item->file_name }}

                                    </td>

                                    <td>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $item->url }}"
                                               readonly>

                                    </td>

                                </tr>

                            @empty

                                <tr class="empty-row">

                                    <td colspan="4" class="text-center">

                                        No Media Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
    <!-- Container-fluid Ends-->

</div>

@endsection



@section('script')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const dropArea = document.getElementById('dropArea');
    const imageUpload = document.getElementById('imageUpload');
    const tableBody = document.getElementById('imageTableBody');
    const deleteBtn = document.querySelector('.delete_all');
    const searchInput = document.querySelector('.search-input');

    if (!dropArea || !imageUpload) return;

    // OPEN FILE INPUT WHEN CLICK
    dropArea.addEventListener('click', function () {
        imageUpload.click();
    });

    // DRAG EVENTS
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.add('bg-light');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.remove('bg-light');
        });
    });

    // DROP FILES
    dropArea.addEventListener('drop', function (e) {
        const files = e.dataTransfer.files;
        if (files.length) uploadImages(files);
    });

    // FILE INPUT CHANGE
    imageUpload.addEventListener('change', function () {
        if (this.files.length) uploadImages(this.files);
    });

    // UPLOAD FUNCTION
    function uploadImages(files) {

        const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

        if (!csrf) {
            console.error("CSRF token not found");
            return;
        }

        Array.from(files).forEach(async (file) => {

            let formData = new FormData();
            formData.append('image', file);

            try {
                const res = await fetch("{{ route('admin.media.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    body: formData
                });

                const data = await res.json();

                if (!data.success) return;

                const emptyRow = document.querySelector('.empty-row');
                if (emptyRow) emptyRow.remove();

                const row = `
                    <tr data-row-id="${data.id}">
                        <td>
                            <input class="checkbox_animated check-it row_checkbox"
                                   type="checkbox"
                                   data-id="${data.id}">
                        </td>

                        <td>
                            <img src="${data.image}"
                                 width="60"
                                 height="60"
                                 style="object-fit:cover;">
                        </td>

                        <td>${data.file_name ?? ''}</td>

                        <td>
                            <input type="text"
                                   class="form-control"
                                   value="${data.url ?? ''}"
                                   readonly>
                        </td>
                    </tr>
                `;

                tableBody.insertAdjacentHTML('afterbegin', row);

            } catch (err) {
                console.error("Upload failed:", err);
            }

        });
    }

    // DELETE SELECTED (UI ONLY)
   if (deleteBtn) {
    deleteBtn.addEventListener('click', async function () {

        const checked = document.querySelectorAll('.row_checkbox:checked');

        if (checked.length === 0) return;

        const ids = Array.from(checked).map(cb => cb.dataset.id);

        try {
            const res = await fetch("{{ route('admin.media.delete') }}", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: JSON.stringify({ ids })
            });

            const data = await res.json();

            console.log(data);

            if (data.success) {
                checked.forEach(cb => {
                    cb.closest('tr').remove();
                });
            }

        } catch (err) {
            console.error(err);
        }

    });
}

    // SEARCH FILTER
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {

            const value = this.value.toLowerCase();
            const rows = document.querySelectorAll('#imageTableBody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            });

        });
    }

});

</script>

{{-- Toastify Message --}}
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

        @if (session('message'))
            Toastify({
                text: "{{ session('message') }}",
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
