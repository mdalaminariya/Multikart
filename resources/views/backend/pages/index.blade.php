@extends('layouts.backendmaster.master')

@section('content')
<div class="page-body">
    <div class="container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>List Page
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">List Page</li>
                    </ol>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-header">

                        {{-- SEARCH --}}
                        <form class="form-inline search-form search-box" method="GET">
                            <div class="form-group">
                                <input class="form-control-plaintext"
                                       type="search"
                                       name="search"
                                       placeholder="Search.."
                                       value="{{ request('search') }}">
                            </div>
                        </form>

                        {{-- ADD BUTTON --}}
                        <a href="{{ route('admin.pages.create') }}"
                           class="btn btn-primary mt-md-0 mt-2">
                            Add New Page
                        </a>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive table-desi">

                            {{-- BULK DELETE FORM --}}
                            <form id="bulkDeleteForm">
                                @csrf

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

                                        @forelse($pages as $page)
                                        <tr data-row-id="{{ $page->id }}">

                                            <td>
                                               <input class="checkbox_animated check-it page-checkbox"
                                                    type="checkbox"
                                                    value="{{ $page->id }}">
                                            </td>

                                            <td>{{ $page->name }}</td>
                                            <td>
                                                @if($page->status == 'waiting')

                                                    <span class="badge badge-warning">
                                                        Waiting
                                                    </span>

                                                @elseif($page->status == 'pending')

                                                    <span class="badge badge-secondary">
                                                        Pending
                                                    </span>

                                                @elseif($page->status == 'success')

                                                    <span class="badge badge-success">
                                                        Success
                                                    </span>

                                                @endif
                                            </td>

                                            <td class="list-date">
                                                {{ $page->created_at->format('M d, Y') }}
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                No Pages Found
                                            </td>
                                        </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

            {{-- delete --}}
<form id="deleteForm" method="POST" style="display:none;">

    @csrf
    @method('DELETE')

</form>

<script>
function deleteSelected()
{
    let checkedBoxes = document.querySelectorAll('.page-checkbox:checked');

    if (checkedBoxes.length === 0) {
        alert('Please select a page');
        return;
    }

    let ids = [];

    checkedBoxes.forEach(cb => {
        ids.push(cb.value);
    });

    // send to backend (GET fallback version)
    window.location.href = "{{ url('/admin/pages/delete') }}/" + ids.join(',');
}
</script>
@endsection

@section('script')
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
