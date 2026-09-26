@extends('layouts.backendmaster.master')

@section('content')
      <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Product List
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
                                    <li class="breadcrumb-item active">Product List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row products-admin ratio_asos">
                         @forelse ($products as $product)
                         <div class="col-xl-3 col-sm-6">
                             <div class="card">
                                 <div class="card-body product-box">
                                     <div class="img-wrapper">
                                         <div class="front">
                                             <a href="{{ route('admin.product.delete', $product->id) }}"><img src="{{ asset('uploads/physical/products/' .$product->image) }}"
                                                     class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                             <div class="product-hover">
                                                 <ul>
                                                     <li>
                                                         <button onclick="window.location='{{ route('admin.product.edit', $product->id) }}'" class="btn" type="button"
                                                             ><i class="fa fa-edit"></i></button>
                                                     </li>
                                                     <li>
                                                         <button onclick="window.location='{{ route('admin.product.delete', $product->id) }}'" class="btn"><i class="fa fa-trash"></i></button>
                                                     </li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="product-detail">
                                         <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                 class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                 class="fa fa-star"></i></div>
                                         <a href="{{ route('admin.product.details', $product->id) }}">
                                             <h6>{{ $product->title }}</h6>
                                         </a>
                                         <h4>${{ $product->price }}<del>${{ $product->discount }}</del></h4>
                                         <td>
                                            @if($product->colors)
                                                <ul class="color-variant">
                                                    @foreach(explode(',', $product->colors) as $color)
                                                        <li style="background-color: {{ $color }};"></li>
                                                    @endforeach
                                                </ul>
                                            @else

                                            <h6>
                                                Color: Not available.
                                            </h6>
                                            
                                            @endif
                                        </td>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @empty
                              <div class="text-center text-danger">
                                  <td>No Product Found.</td>
                              </div>
                         @endforelse
                     </div>
                 </div>
                <!-- Container-fluid Ends-->
            </div>
@endsection

@section('script')
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
