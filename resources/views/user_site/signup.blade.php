@extends('user_site.master_layout.masterUser')
@section('content')
    <style>
        #ferror,
        #lerror,
        #phnerror,
        #emlerror,
        #stterror,
        #cnterror,
        #cterror,
        #a1error,
        #a2error,
        #pcerror,
        #pswrderror,
        #cperror {
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

                <div class="row justify-content-center">

                    <!--Form Sign In-->
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form id="signUpData);" action="{{ route('userRegister.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-md-6">



                                        <p class="form-row">
                                            <label for="fid-name">First Name<span class="requite">*</span></label>
                                            <input type="text" id="fn" name="name" value=""
                                                class="txt-input">
                                            <span id="ferror"></span>
                                        </p>
                                        <span id="fnameerror"></span>
                                        <p class="form-row">
                                            <label for="fid-name">Last Name<span class="requite">*</span></label>
                                            <input type="text" id="last" name="lastname" value=""
                                                class="txt-input">
                                            <span id="lerror"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-name">Email Address:<span class="requite">*</span></label>
                                            <input type="email" id="email" name="email" value=""
                                                class="txt-input">
                                            <span id="emlerror"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-name">Phone#<span class="requite">*</span></label>
                                            <input type="tel" id="phne" name="phone" value=""
                                                class="txt-input">
                                            <span id="phnerror"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-name">Country<span class="requite">*</span></label>
                                            <input type="text" id="country" name="country" value=""
                                                class="txt-input">
                                            <span id="cnterror"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-name">State<span class="requite">*</span></label>
                                            <input type="text" id="state" name="state" value=""
                                                class="txt-input">
                                            <span id="stterror"></span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="form-row">
                                            <label for="fid-name">City<span class="requite">*</span></label>
                                            <input type="text" id="city" name="city" value=""
                                                class="txt-input">
                                            <span id="cterror"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-name">Postal code<span class="requite">*</span></label>
                                            <input type="number" id="postal" name="postal_code" value=""
                                                class="txt-input">

                                            <span id="pcerror"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-pass">Address-1<span class="requite">*</span></label>
                                            <input type="text" id="address_1" name="address_1" value=""
                                                class="txt-input">
                                            <span id="a1error"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-pass">Address-2<span class="requite">*</span></label>
                                            <input type="text" id="address_2" name="address_2" value=""
                                                class="txt-input">
                                            <span id="a2error"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-pass">Password<span class="requite">*</span></label>
                                            <input type="password" id="pass" name="password" value=""
                                                class="txt-input">
                                            <span id="pswrderror"></span>
                                        </p>
                                        <p class="form-row">
                                            <label for="fid-pass">Confirm Password<span class="requite">*</span></label>
                                            <input type="password"id="password_confirmation" name="password_confirmation"
                                                required autocomplete="new-password" class="txt-input">
                                            <span id="cperror"></span>
                                        </p>
                                    </div>
                                </div>

                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" id="logbtn" name="submit" value="submit"
                                        type="submit">Submit</button>

                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        $(document).ready(function() {
            $(document).on("submit", "#signUpData);", function(e) {
                e.preventDefault();
                var mydata = new FormData(signUpData);
                $.ajax({
                    url: "./ajax/signupajax.php",
                    method: "POST",
                    data: mydata,
                    processData: false,
                    contentType: false,
                    success: function(val) {
                        if (val == 1) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: "<h4>Please Fill All Required Fields</h4>"
                            });
                        } else if (val == 2) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "warning",
                                title: "<h4>User E-mail Already Exist</h4>"
                            });
                        } else if (val == 3) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: "<h4>Registered successfully</h4>"
                            });
                            setTimeout(function() {
                                window.location.href = "./login.php";
                            }, 500)
                            $("#signUpData);").trigger("reset")
                        } else if (val == 4) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: "<h4>Registered Failed</h4>"
                            });
                            $("#signUpData);").trigger("reset")
                        } else if (val == 5) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: "<h4>Passwrod Does not macth</h4>"
                            });
                        } else {

                            alert(val);
                        }
                    }

                })
            })
        })
    </script> -->

    </body>

    </html>
@endsection
