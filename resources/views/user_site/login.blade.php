
@extends('user_site.master_layout.masterUser')
@section('content')
    <style>
        #emailerror,
        #passworderror {
            color: red;
        }
    </style>
    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">Organic Fruits</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Authentication</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">

                <div class="row">

                    <!--Form Sign In-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form id="formdata" action="{{ route('userLogin.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <p class="form-row">
                                    <label for="fid-name">Email Address<span class="requite">*</span></label>
                                    <input type="email" id="email" name="email" placeholder="Enter Email" class="txt-input">
                                    <span id="emailerror">
                                        @error('email') {{ $message }} @enderror
                                    </span>
                                </p>
                                <p class="form-row">
                                    <label for="fid-pass">Password<span class="requite">*</span></label>
                                    <input type="password" id="password" name="password" >
                                    <span id="emailerror">
                                        @error('password') {{ $message }} @enderror
                                    </span>
                                </p>

                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" id="logbtn" type="submit">sign in</button>
                                    <button class="btn btn-submit btn-bold" ><a style="color: white;"
                                            href="{{ route('userRegister') }}">sign up</a></button>
                                    <a href="#" class="link-to-help">Forgot your password</a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!--Go to Register form-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">New Customer?</h4>
                                <p class="sub-title">Create an account with us and you’ll be able to:</p>
                                <ul class="lis">
                                    <li>Check out faster</li>
                                    <li>Save multiple shipping anddesses</li>
                                    <li>Access your order history</li>
                                    <li>Track new orders</li>
                                    <li>Save items to your Wishlist</li>
                                </ul>
                                <a href="{{ route('userRegister') }}" class="btn btn-bold">Create an account</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
