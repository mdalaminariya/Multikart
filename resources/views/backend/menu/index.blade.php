@extends('layouts.backendmaster.master')

@section('content')
 <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Menu Lists
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
                                    <li class="breadcrumb-item">Menus</li>
                                    <li class="breadcrumb-item active">Menu Lists</li>
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

                                    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mt-md-0 mt-2">Create Menu</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive table-desi">
                                        <table class="all-package coupon-table table table-striped">
                                            <thead>
                                                <tr>
                                                        <th>
                                                             <button type="button"
                                                                class="btn btn-primary add-row delete_all"
                                                                onclick="deleteSelected()">

                                                                Delete

                                                            </button>
                                                        </th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Created On</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @forelse($menus as $menu)

                                                    <tr data-row-id="{{ $menu->id }}">

                                                        <td>
                                                          <input
                                                                class="checkbox_animated check-it"
                                                                type="checkbox"
                                                                value="{{ $menu->id }}"
                                                                name="menu_ids[]">
                                                        </td>

                                                        <td>
                                                            {{ $menu->name }}
                                                        </td>
                                                            <td>

                                                                @if($menu->status == 'waiting')

                                                                    <span class="badge badge-warning">
                                                                        Waiting
                                                                    </span>

                                                                @elseif($menu->status == 'pending')

                                                                    <span class="badge badge-secondary">
                                                                        Pending
                                                                    </span>

                                                                @elseif($menu->status == 'success')

                                                                    <span class="badge badge-success">
                                                                        Success
                                                                    </span>

                                                                @endif

                                                            </td>

                                                        <td class="list-date">
                                                            {{ $menu->created_at->format('d M Y') }}
                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>
                                                        <td colspan="4" class="text-center">
                                                            No Menu Found
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

            {{-- delete --}}
<form id="deleteForm" method="POST" style="display:none;">

    @csrf
    @method('DELETE')

</form>

<script>

    function deleteSelected()
    {
        let checked = document.querySelector('input[name="menu_ids[]"]:checked');

        if(!checked)
        {
            alert('Please select menu');

            return;
        }

        window.location.href = "{{ url('/admin/menu/delete') }}/" + checked.value;
    }

</script>

@endsection

@section('script')

<script>

document.addEventListener('DOMContentLoaded', function () {

    // SUCCESS TOAST
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


    // ERROR TOAST
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
