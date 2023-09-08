@extends('layouts.admin');

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Create Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Create Category</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form action="{{ route('category.store') }}" method="post">@csrf

                <div class="row">

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                @foreach ($errors->all() as $error)
                                    <ul>
                                        <li class="text-danger">{{ $error }}</li>
                                    </ul>
                                @endforeach
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Category Title</label>

                                    <input type="text" class="form-control" required name="name"
                                        placeholder="Enter category title">
                                    <div class="invalid-feedback">Please Enter a category title.</div>
                                </div>

                            </div>
                        </div>
                        <!-- end card -->




                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>
                    <!-- end col -->
            </form>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-6">
                                    <div class="mb-3">
                                        <div class="card card-body shadow-lg">
                                            <p class="card-text">
                                                {{ $category->name }}
                                            </p>
                                            <div class="d-flex">
                                                <a href="#">
                                                    <button class="btn btn-warning btn-sm me-2" type="button">Edit</button>
                                                </a>
                                                <form method="POST" action="{{ route('category.destroy', $category) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('category.destroy', $category) }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </a>
                                                </form>



                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>



                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->



            </div>
            <!-- end col -->
        </div>
        <!-- end row -->



    </div>
    <!-- container-fluid -->
    </div>
@endsection
