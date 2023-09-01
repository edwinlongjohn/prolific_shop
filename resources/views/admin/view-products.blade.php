@extends('layouts.admin')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">


            <div class="col-xl-12 col-lg-12">
                <div>
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row g-4">
                                <div class="col-sm-auto">
                                    <div>
                                        <a href="apps-ecommerce-add-product.html" class="btn btn-success"
                                            id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add
                                            Product</a>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control" id="searchProductList"
                                                placeholder="Search Products...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                                href="#productnav-all" role="tab">
                                                All <span
                                                    class="badge badge-soft-danger align-middle rounded-pill ms-1">12</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                href="#productnav-published" role="tab">
                                                Published <span
                                                    class="badge badge-soft-danger align-middle rounded-pill ms-1">5</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                href="#productnav-draft" role="tab">
                                                Draft
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <div id="selection-element">
                                        <div class="my-n1 d-flex align-items-center text-muted">
                                            Select <div id="select-content" class="text-body fw-semibold px-1"></div>
                                            Result <button type="button" class="btn btn-link link-danger p-0 ms-3"
                                                data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">

                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Features</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Date/Time added</th>
                                                        <th scope="col">Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $p)
                                                    <tr>


                                                        <td>
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <img src="/storage/product_display_images/{{$p->image}}"
                                                                        alt="{{$p->image}}"
                                                                        class="avatar-xs rounded-circle" />
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    {{$p->name}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$p->category->name}}
                                                        </td>


                                                        <td class="text-success">
                                                            <i class="ri-checkbox-circle-line fs-17 align-middle"></i>
                                                            {{$p->features}}
                                                        </td>





                                                        <td>N{{number_format($p->price)}}.00</td>



                                                        <td>
                                                            {{$p->created_at->format('m/d/Y-h:i:a')}}
                                                        </td>

                                                        <td>
                                                            <a href="{{route('admin.view_product_details', $p->id)}}"
                                                                class="btn btn-secondary text-white">View
                                                                Details</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach


                                                </tbody>
                                                {{-- <tfoot class="table-light">
                                                            <tr>
                                                                <td colspan="6">Total</td>
                                                                <td>$947.55</td>
                                                            </tr>
                                                        </tfoot> --}}
                                            </table>
                                            <!-- end table -->
                                        </div>
                                        <!-- end table responsive -->
                                    </div>
                                </div>
                                <!-- end tab pane -->

                                <div class="tab-pane" id="productnav-published" role="tabpanel">
                                    <div id="table-product-list-published" class="table-card gridjs-border-none"></div>
                                </div>
                                <!-- end tab pane -->

                                <div class="tab-pane" id="productnav-draft" role="tabpanel">
                                    <div class="py-4 text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px">
                                        </lord-icon>
                                        <h5 class="mt-4">Sorry! No Result Found</h5>
                                    </div>
                                </div>
                                <!-- end tab pane -->
                            </div>
                            <!-- end tab content -->

                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection
