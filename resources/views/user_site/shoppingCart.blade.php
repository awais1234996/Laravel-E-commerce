@extends('user_site.master_layout.masterUser')
@section('content')
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

    <div class="page-contain shopping-cart">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">

                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Your cart items</h3>
                            <form class="shopping-cart-form">
                                <table class="shop_table cart-form">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product Picture</th>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-name">Product Code</th>
                                            <th class="product-name">Product Price</th>
                                            <th class="product-name">Product Quantity</th>
                                            <th class="product-price">Product Total Price</th>
                                            <th class="product-price">Delete</th>

                                        </tr>
                                    </thead>

                                    @foreach (DB::table('carts')->where('cart_email', Auth::guard('user')->user()->email)->get() as $item)
                                        @php
                                            $carttotal = 0;
                                            $cart_email = Auth::guard('user')->user()->email;

                                        @endphp
                                        <tbody>

                                            <tr class="cart_item">
                                                <td>

                                                    <img width="150px" height="150px"
                                                        src="{{ asset('product_images/' . $item->product_image) }}" />
                                                <td>
                                                    {{ $item->product_name }}
                                                </td>
                                                <td>
                                                    {{ $item->product_code }}

                                                </td>
                                                <td>
                                                    {{ $item->unit_price }}

                                                </td>

                                                <td class="product-quantity" data-title="Quantity">
                                                    <div class="quantity-box type1">
                                                        <div class="qty-input">
                                                            <input type="hidden" name="cartid" value="{{ $item->id }}"
                                                                id="cartid">
                                                            <input type="hidden" name="cartprice"
                                                                value="{{ $item->unit_price }}" id="cartprice">
                                                            <input type="number" class="cart-qty" name="cartqty"
                                                                value="{{ $item->product_quantity }}" data-id="{{ $item->id }}"
                                                                data-price="{{ $item->unit_price }}" min="1"
                                                                max="20">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart-total" id="cart-total-{{ $item->id }}">
                                                    {{ $item->total_price }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-danger-delete delete-btn"><i
                                                                class="fa-solid fa-trash-can"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    @endforeach
                                    <tr class="cart_item wrap-buttons">
                                        <td class="wrap-btn-control" colspan="4">
                                            <a class="btn back-to-shop" href="{{ route('userProduct.index') }}">Back to
                                                Shop</a>
                                            @php
                                                $cart_email = Auth::guard('user')->user()->email;

                                            @endphp
                                            <form action="{{ route('cartP.destroy', Auth::user()->email) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-danger-delete delete-all">
                                                    <i class="fa-solid fa-trash-can"></i> Delete All
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                    </tbody>


                                </table>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="shpcart-subtotal-block">
                                <div class="subtotal-line">
                                    <b class="stt-name">Subtotal <span class="sub">(2-items)</span></b>
                                    <span class="stt-price"></span>
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name">Shipping</b>
                                    <span class="stt-price">£0.00</span>
                                </div>
                                <div class="tax-fee">
                                    <p class="title">Est. Taxes & Fees</p>
                                    <p class="desc">Based on 56789</p>
                                </div>
                                <div class="btn-checkout">
                                    <a href="./checkout.php" class="btn checkout">Check out</a>
                                </div>
                                <div class="biolife-progress-bar">
                                    <table>
                                        <tr>
                                            <td class="first-position">
                                                <span class="index">$0</span>
                                            </td>
                                            <td class="mid-position">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="last-position">
                                                <span class="index">$99</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about shipping
                                    and pickup</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Related Product-->


            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = button.closest('form');

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                            swalWithBootstrapButtons.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: "Cancelled",
                                text: "Your imaginary file is safe :)",
                                icon: "error"
                            });
                        }
                    });
                });
            });
        });

        // Delete All



        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-all').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = button.closest('form');

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                            swalWithBootstrapButtons.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: "Cancelled",
                                text: "Your imaginary file is safe :)",
                                icon: "error"
                            });
                        }
                    });
                });
            });
        });



        $(document).ready(function() {
    $(".cart-qty").on("change", function() {
        let cartId = $(this).data("id");
        let newQty = $(this).val();
        let unitPrice = $(this).data("price");

        console.log("Updating cart ID:", cartId, "New Quantity:", newQty, "Unit Price:", unitPrice);

        $.ajax({
            url: "{{ route('cartP.update') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: cartId,
                quantity: newQty
            },
            success: function(response) {
                console.log("Response received:", response);

                if (response.success) {
                    $("#cart-total-" + cartId).text(response.item_total);


                    // Update the grand total
                    $("#cart-grand-total").text(response.cart_total);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});

    </script>
@endsection
