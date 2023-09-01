@extends('layouts.admin')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Create Product</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Create Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <form id="createproduct-form" action="{{route('admin.submit_product')}}" method="POST" enctype="multipart/form-data"> @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <ul>
                                @foreach ($errors->all() as $err)
                                <li class="text-danger">{{$err}}</li>
                             @endforeach
                            </ul>

                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Product Title</label>

                                <input type="text" name="name" class="form-control" placeholder="Enter product title" >
                            </div>
                            <div>
                                <label>Product Description</label>
                                <textarea class="form-control" name="description" placeholder="Please enter description" rows="15"></textarea>

                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Product Gallery</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fs-14 mb-1">Product Image</h5>
                                <p class="text-muted">Add Product main Image.</p>
                                <div class="text-center">
                                 <input class="form-control "  type="file" name="image" accept="image/png, image/gif, image/jpeg">
                                </div>
                            </div>
                            <div>
                                <h5 class="fs-14 mb-1">Product Gallery</h5>
                                <p class="text-muted">Add Product Gallery Images.</p>

                                <div class="dropzone">
                                    <div class="fallback">
                                        <input  type="file" multiple="multiple" name="gallery[]" >
                                    </div>

                                </div>


                                <!-- end dropzon-preview -->
                            </div>
                        </div>
                    </div>
                    <!-- end card -->



                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Product Categories</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2"> <a href="{{route('category.index')}}" class="float-end text-decoration-underline">Add
                                    New</a>Select product category</p>
                            <select class="form-select"  name="category_id" >
                                 @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                 @endforeach

                            </select>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">other fields</h5>
                        </div>
                        <!-- end card body -->
                        <div class="card-body">
                            <div>
                                <label for="datepicker-publish-input" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="Enter price" >
                            </div>
                            <div>
                                <label for="datepicker-publish-input" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="quantity" placeholder="Enter quantity" >
                            </div>
                            <div>
                                <label for="datepicker-publish-input" class="form-label">Features</label>
                                <input type="text" class="form-control" name="features" placeholder="e.g red, quality assured, beautiful" >
                            </div>
                        </div>
                    </div>
                    <!-- end card -->






                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
              <!-- end card -->
            <div class="text-end mb-3">
                <button type="submit" class="btn btn-success w-sm">Submit</button>
            </div>
        </form>

    </div>
    <!-- container-fluid -->
</div>
@endsection
