@extends('layouts.backendmaster.master')

@section('content')
                <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>User List
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
                                    <li class="breadcrumb-item">Users</li>
                                    <li class="breadcrumb-item active">User List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <form class="form-inline search-form search-box">
                                <div class="form-group">
                                    <input class="form-control-plaintext" type="search" placeholder="Search.."><span
                                        class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                                </div>
                            </form>

                            <a href="create-user.html" class="btn btn-primary mt-md-0 mt-2">Create User</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-desi">
                                <table class="all-package coupon-table media-table table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                            <button type="button"
                                                class="btn btn-primary add-row delete_all">
                                                Delete
                                            </button>
                                        </th>
                                            <th>Avtar</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Last Login</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr data-row-id="1">
                                                <td>
                                                  <input type="checkbox"
                                                    class="checkbox_animated check-it user-checkbox"
                                                    value="{{ $user->id }}">
                                                </td>

                                                <td>
                                                    @if ($user->image == 'default.png')
                                                    <img src="{{ asset('uploads/profile/default/default.png') }}" alt="">
                                                    @else
                                                    <img src="{{ asset('uploads/profile/' . $user->image) }}" alt="">
                                                    @endif
                                                </td>

                                                <td>{{ $user->fname }}</td>

                                                <td>{{ $user->lname }}</td>

                                                <td>{{ $user->email }}</td>

                                                <td>{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</td>

                                                <td>{{ $user->role }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No users found.</td>
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

    // ================= TOAST =================
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


    // ================= ROUTE =================
    let updateRoute = "{{ route('admin.subcategory.update', ':id') }}";


    // ================= EDIT SUBCATEGORY =================
    document.querySelectorAll('.edit-subcategory').forEach(function (btn) {
        btn.addEventListener('click', function () {

            let id = this.dataset.id;
            let name = this.dataset.name;
            let image = this.dataset.image;

            // set form action
            document.getElementById('categoryForm').action =
                updateRoute.replace(':id', id);

            // set hidden id
            document.getElementById('category_id').value = id;

            // SAFE input set
            let nameInput = document.querySelector('input[name="name"]');
            if (nameInput) {
                nameInput.value = name;
            }

            // update modal title
            document.getElementById('modalTitle').innerText = "Edit SubCategory";
        });
    });


    // ================= RESET MODAL =================
    let modal = document.getElementById('categoryModal');

    modal.addEventListener('hidden.bs.modal', function () {

        document.getElementById('categoryForm').action = "{{ route('admin.subcategory.store') }}";
        document.getElementById('categoryForm').reset();
        document.getElementById('category_id').value = "";
        document.getElementById('modalTitle').innerText = "Add SubCategory";
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // DELETE USERS
    document.querySelector('.delete_all').addEventListener('click', function () {

        let checked = document.querySelectorAll('.user-checkbox:checked');

        if (checked.length == 0) {

            Toastify({
                text: "Please select users first",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "linear-gradient(to right, #ff416c, #ff4b2b)",
                }
            }).showToast();

            return;
        }

        if (confirm('Are you sure you want to delete selected user?')) {

            checked.forEach(function (item) {

                let id = item.value;

                window.location.href =
                    "{{ url('/admin/users/registration/delete') }}/" + id;

            });

        }

    });

});
</script>
@endsection
