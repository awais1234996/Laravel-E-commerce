@extends('user_site.master_layout.masterUser')
@section('content')
    <style>
        .cbtn {
            width: 450px;
            font-size: 25px;
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
                <li class="nav-item"><span class="current-page">ShoppingCart</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain checkout">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container sm-margin-top-37px">
                <div class="row">

                    <!--checkout progress box-->
                    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                        <div class="checkout-progress-wrap">
                            <ul class="steps">
                                <li class="step 1st">
                                    <div class="checkout-act active">
                                        <h3 class="title-box"><span class="number">1</span>Customer</h3>
                                        <div class="box-content">
                                            <p class="txt-desc">Checking out as a <a class="pmlink"
                                                    href="#">Guest?</a> You’ll be able to save your details to create
                                                an account with us later.</p>


                                            <div class="login-on-checkout">
                                                <form id="checkdata" action="{{ route('checkout.store') }}" method="post">
                                                    @csrf
                                                    <p class="form-row">
                                                        <label for="fid-name">Name<span class="requite">*</span></label>
                                                        <input type="text" id="fn" onblur="" name="name"
                                                            value="" class="txt-input">
                                                        <span id="ferror"></span>
                                                    </p>
                                                    <span id="fnameerror"></span>
                                                    @php
                                                        $email = Auth::guard('user')->user()->email;
                                                    @endphp
                                                    <p class="form-row">
                                                        <label for="fid-name">Email Address:<span
                                                                class="requite">*</span></label>
                                                        <input type="email" readonly id="email" onblur="eml()"
                                                            name="email" value="{{ $email }}" class="txt-input">
                                                        <span id="emlerror"></span>
                                                    </p>
                                                    <p class="form-row">
                                                        <label for="fid-name">Phone#<span class="requite">*</span></label>
                                                        <input type="tel" id="phne" onblur="phonn()" name="phone"
                                                            value="" class="txt-input">
                                                        <span id="phnerror"></span>
                                                    </p>
                                                    <p class="form-row">
                                                        <label for="fid-name">Country<span class="requite">*</span></label>
                                                        <input type="text" id="country" onblur="cnt()" name="country"
                                                            value="" class="txt-input">
                                                        <span id="cnterror"></span>
                                                    </p>
                                                    <p class="form-row">
                                                        <label for="fid-name">State<span class="requite">*</span></label>
                                                        <input type="text" id="state" onblur="stt()" name="state"
                                                            value="" class="txt-input">
                                                        <span id="stterror"></span>
                                                    </p>
                                                    <p class="form-row">
                                                        <label for="fid-name">City<span class="requite">*</span></label>
                                                        <input type="text" id="city" onblur="ct()" name="city"
                                                            value="" class="txt-input">
                                                        <span id="cterror"></span>
                                                    </p>
                                                    <p class="form-row">
                                                        <label for="fid-name">Postal Code<span
                                                                class="requite">*</span></label>
                                                        <input type="number" id="city" onblur="ct()"
                                                            name="postal_code" value="" class="txt-input">
                                                        <span id="cterror"></span>
                                                    </p>

                                                    <p class="form-row">
                                                        <label for="fid-pass">Address<span
                                                                class="requite">*</span></label>
                                                        <input type="text" id="address" onblur="a2()"
                                                            name="address" value="" class="txt-input">
                                                        <span id="a2error"></span>
                                                    </p>



                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="step 2nd">
                                    <div class="checkout-act">
                                        <h3 class="title-box"><span class="number">2</span>Shipping</h3>
                                    </div>
                                </li>
                                <li class="step 3rd">
                                    <div class="checkout-act">
                                        <h3 class="title-box"><span class="number">3</span>Billing</h3>
                                    </div>
                                </li>
                                <li class="step 4th">
                                    <div class="checkout-act">
                                        <h3 class="title-box"><span class="number">4</span>Payment</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--Order Summary-->
                    <div
                        class="col-lg-5 col-md-5 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                        <div class="order-summary sm-margin-bottom-80px">
                            <div class="title-block">
                                <h3 class="title">Order Summary</h3>
                                <a href="#" class="link-forward">Edit cart</a>
                            </div>


                            <table class="shop_table cart-form">
                                <tr>

                                    <th><b>Product Name</b></th>
                                    <th><b>Price</b></th>
                                    <th><b>QTY</b></th>
                                    <th><b>Total price</b></th>

                                </tr>
                                @php
                                    $carttotal = 0;
                                @endphp
                                @foreach (DB::table('carts')->where('cart_email', Auth::guard('user')->user()->email)->get() as $item)
                                    <tr>

                                        <th>{{ $item->product_name }}</th>
                                        <th>{{ $item->unit_price }}</th>
                                        <th>{{ $item->product_quantity }}</th>
                                        <th>{{ $item->total_price }}</th>


                                    </tr>
                                @endforeach



                            </table>


                            <div class="col-lg-12">
                                <div class="">
                                    <div class="subtotal-line">
                                        @php
                                            $sql = DB::table('carts')
                                                ->where('cart_email', Auth::guard('user')->user()->email)
                                                ->get();
                                        @endphp
                                        <b class="stt-name">Total Products<span
                                                class="sub">({{ count($sql) }}-Items)</span></b>
                                        <span class="stt-price"></span>
                                    </div>
                                    <div class="subtotal-line">
                                        <b class="stt-name">SubTotal</b>
                                        <span
                                            class="stt-price">{{ DB::table('carts')->where('cart_email', Auth::guard('user')->user()->email)->sum('total_price') }}
                                        </span>
                                    </div>
                                    <div class="subtotal-line">
                                        <b class="stt-name">Shipping</b>
                                        <span class="stt-price">Free</span>
                                    </div>



                                    <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about
                                        shipping and pickup</p>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-submit btn-success cbtn">Place Order</button>
                        <br><br>
                        <a href="{{ route('userProduct.index') }}" type="button" class="btn cbtn btn-primary ">
                            Add to cart
                        </a><br><br>
                        <a href="{{ route('shoppingCart.create') }}" type="button" class="btn cbtn btn-warning">
                            Shopping
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </form>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ Session::get('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        </script>
    @elseif (Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ Session::get('error') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        </script>
    @endif
@endsection
