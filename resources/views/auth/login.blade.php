@extends('layouts.other_guest')

@section('content')
<main class="main login-page">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">My Account</h1>

        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="demo1.html">Home</a></li>
                <li>My account</li>
            </ul>

        </div>
    </nav>
    <!-- End of Breadcrumb -->
    <div class="page-content">

        <div class="container">

            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#sign-in" class="nav-link active">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a href="#sign-up" class="nav-link">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sign-in">
                            <form action="{{route('login')}}" method="post"> @csrf
                            <div class="form-group">
                                <label> email address *</label>
                                <input type="text" class="form-control" name="email" id="username" required>
                            </div>

                            <div class="form-group mb-0">
                                <label>Password *</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="form-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1" required="">
                                <label for="remember1">Remember me</label>
                                <a href="#">Lost your password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign In</a>
                        </form>
                        </div>
                        <div class="tab-pane" id="sign-up">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li class="text-danger">{{$error}}</li>
                            @endforeach
                            </ul>
                        <form action="{{route('register')}}" method="POST"> @csrf

                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" class="form-control" name="name" id="email_1" required>
                            </div>
                            <div class="form-group">
                                <label>Your email address *</label>
                                <input type="email" class="form-control" name="email" id="email_1" required>
                            </div>
                            <div class="form-group">
                                <label>Phone Number *</label>
                                <input type="tel" class="form-control" name="phone" id="email_1" required>
                            </div>
                            <div class="form-group mb-5">
                                <label>Password *</label>
                                <input type="password" class="form-control" name="password" id="password_1" required>
                            </div>
                            <div class="form-group mb-5">
                                <label>Confirm Password *</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_1" required>
                            </div>


                            <p>Your personal data will be used to support your experience
                                throughout this website, to manage access to your account,
                                and for other purposes described in our <a href="#" class="text-primary">privacy policy</a>.</p>

                            <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                <input type="checkbox" class="custom-checkbox" id="remember" name="remember" required="">
                                <label for="remember" class="font-size-md">I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                            </div>
                            <button  type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                        </div>
                    </div>
                    <p class="text-center">Sign in with social account</p>
                    <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-google fab fa-google"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
