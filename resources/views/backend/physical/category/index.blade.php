@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Category
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
                        <li class="breadcrumb-item active">Category</li>
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

                    <div class="card-header">
                        <form class="form-inline search-form search-box">
                            <div class="form-group">
                                <input class="form-control-plaintext" type="search" placeholder="Search..">
                            </div>
                        </form>

                        <button type="button" class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#categoryModal">
                            Add Category
                        </button>
                    </div>

                    <div class="card-body">

                        <!-- ✅ MODAL (MOVED OUTSIDE TABLE) -->
                        <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitle">Add Category</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                      <form id="categoryForm" action="{{ route('admin.category.store') }}"
                                        method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="category_id" id="category_id">

                                            <div class="form-group mb-3">
                                                <label>Category Name :</label>
                                                <input class="form-control" name="name" type="text">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Category Image :</label>
                                                <input class="form-control" name="image" type="file">
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" form="categoryForm" class="btn btn-primary">
                                            Save
                                        </button>
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- ✅ MODAL END -->

                        <!-- ✅ TABLE -->
                        <div class="table-responsive table-desi">
                            <table class="table all-package table-category" id="editableTable">

                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('uploads/physical/categories/' . $category->image) }}" width="50">
                                        </td>

                                        <td>{{ $category->name }}</td>

                                        <td>
                                            <span class="badge bg-{{ $category->status ? 'success' : 'secondary' }}">
                                                {{ $category->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <td>
                                           <a href="javascript:void(0)"
                                            class="edit-category"
                                            data-bs-toggle="modal"
                                            data-bs-target="#categoryModal"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-image="{{ asset('uploads/categories/' . $category->image) }}">
                                                <i class="fa fa-edit" title="Edit"></i>
                                            </a>

                                            <a href="{{ route('admin.category.delete', $category->id) }}">
                                                <i class="fa fa-trash" title="Delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-danger">
                                            No categories found.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>

                            </table>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Toast messages
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



    // Category update route template
    let updateRoute = "{{ route('admin.category.update', ':id') }}";

    // EDIT BUTTON CLICK
    document.querySelectorAll('.edit-category').forEach(function (btn) {
        btn.addEventListener('click', function () {

            let id = this.dataset.id;
            let name = this.dataset.name;
            let image = this.dataset.image;

            // FIXED: proper URL replace
            document.getElementById('categoryForm').action =
                updateRoute.replace(':id', id);

            // fill id
            document.getElementById('category_id').value = id;

            // fill name
            document.querySelector('input[name="name"]').value = name;

            // change modal title
            document.getElementById('modalTitle').innerText = "Edit Category";
        });
    });


    // RESET MODAL WHEN CLOSED
    let modal = document.getElementById('categoryModal');

    modal.addEventListener('hidden.bs.modal', function () {

        document.getElementById('categoryForm').action = "{{ route('admin.category.store') }}";
        document.getElementById('categoryForm').reset();
        document.getElementById('category_id').value = "";
        document.getElementById('modalTitle').innerText = "Add Category";
    });

});
</script>
@endsection
