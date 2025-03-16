@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="page-title">Update POS</h4>
                </div>
                <div class="col-sm-6">
                    <center>
                        <h4 class="page-title">
                            <a href="{{ route('pos_userinfo.index') }}" class="btn btn-primary">View POS</a>
                        </h4>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="table-responsive table-hover">
                            <table class="table mb-0 new-patient-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Add</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->product_code }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->unit_price }}</td>

                                            <form action="{{ route('pos_orderinfo.store') }}" method="post" id="formdata">
                                                @csrf
                                                @method('POST')
                                                <td>
                                                    <input type="number" id="pqty" class="form-control"
                                                        name="product_quantity" max="20" min="1"
                                                        style="width: 80px; border:rgb(194, 194, 194) solid 1px;"
                                                        value="1">
                                                </td>
                                                <input type="hidden" name="product_name" value="{{ $item->product_name }}">
                                                <input type="hidden" name="order_invoice"
                                                    value="{{ $user->invoice_number }}" id="order_invoice">
                                                <input type="hidden" name="product_code" value="{{ $item->product_code }}">
                                                <input type="hidden" name="unit_price" value="{{ $item->unit_price }}">
                                                <td>
                                                    <div class="text-right">
                                                        <input type="submit" value="Add" class="btn btn-primary">
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </div><br><br>
                </div>


                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="page-title">Invoice</h4>
                        </div>
                    </div>
                    <div class="card-box">

                        <form method="post" action="{{ route('pos_userinfo.update', $user->invoice_number) }}"
                            id="invoicedata">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label><b>Invoice#</b></label>


                                <input type="text" value="{{ $user->invoice_number }}" readonly id="invoice"
                                    name="invoice" class="form-control @error('invoice') is-invalid @enderror">

                                <span class="text-danger">
                                    @error('invoice')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>User Name</b></label>
                                <input type="text" name="user_name" value="{{ $user->user_name }}"
                                    class="form-control @error('user_name') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('user_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Contact#</b></label>
                                <input type="number" name="contact" value="{{ $user->contact }}"
                                    class="form-control @error('contact') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('contact')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>Total Cash</b></label>
                                @php
                                    $totalAmount = DB::table('pos_orderinfo')
                                        ->where('order_invoice', $user->invoice_number)
                                        ->sum('order_total_price');
                                @endphp
                                <input type="number" name="total_cash" readonly value="{{ $user->total_cash }}"
                                    class="form-control @error('total_cash') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('total_cash')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Status</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="Completed"
                                        class="form-check-input @error('status') is-invalid @enderror"
                                        {{ $user->status === 'Completed' ? 'checked' : '' }}>
                                    <label class="form-check-label">Completed</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="status" value="Pending"
                                            class="form-check-input @error('status') is-invalid @enderror"
                                            {{ $user->status === 'Pending' ? 'checked' : '' }}>
                                        <label class="form-check-label">Pending</label>
                                    </div>

                                </div><br>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="text-right">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>



                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">POS View</h4>
                            </div>
                        </div>
                        <div class="card-box">
                            <div class="table-responsive table-hover">
                                <table class="table mb-0 new-patient-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Delete</th>


                                        </tr>
                                    </thead>

                                    <tbody id="postable">

                                    </tbody>
                                    @foreach ($pos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->order_code }}</td>
                                            <td>{{ $item->order_product_name }}</td>
                                            <td>{{ $item->order_unit_price }}</td>
                                            <td>
                                                <form action="{{ route('pos_orderinfo.update', $item->id) }}"
                                                    method="POST" class="update-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" class="form-control qty-input pqty"
                                                        name="order_quantity" max="20" min="1"
                                                        style="width: 80px; border:rgb(194, 194, 194) solid 1px;"
                                                        value="{{ $item->order_quantity }}"
                                                        data-unit-price="{{ $item->order_unit_price }}"
                                                        data-item-id="{{ $item->id }}">

                                                    <input type="hidden" name="order_product_name"
                                                        value="{{ $item->order_product_name }}">
                                                    <input type="hidden" name="order_code"
                                                        value="{{ $item->order_code }}">
                                                    <input type="hidden" name="order_unit_price"
                                                        value="{{ $item->order_unit_price }}">
                                                </form>
                                            </td>
                                            <td class="total-price">{{ $item->order_total_price }}</td>

                                            <td>
                                                <form action="{{ route('pos_orderinfo.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-danger-delete delete-btn">
                                                        <i class="fa-solid fa-trash-can"></i> Delete
                                                    </button>
                                                </form>
                                            </td>




                                        </tr>
                                    @endforeach
                                    <tr>
                                        @php
                                            $totalAmount = DB::table('pos_orderinfo')->sum('order_total_price');
                                        @endphp
                                        <th>
                                            <h2>Total Amount:-</h2>
                                        </th>
                                        <td colspan="5">
                                            <center>
                                                <h3>{{ $totalAmount }}</h3>
                                            </center>
                                        </td>
                                        <td>
                                            <form action="{{ route('pos_orderinfo.show', $item->order_invoice) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-danger-delete delete-btn">
                                                    <i class="fa-solid fa-trash-can"></i><br> Delete All
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                </table>
                            </div><br><br>
                            {{ $pos->links('pagination::bootstrap-5') }}
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <script>
            $(document).ready(function() {
                $(document).on('submit', '#formdata', function(e) {
                    e.preventDefault();
                    var mydata = new FormData(this);
                    var invoice = $('#invoice').val();

                    $('#order_invoice').val(invoice);

                    // console.log('Invoice Value:', inv);
                    $.ajax({
                        url: "{{ route('pos_orderinfo.store') }}",
                        method: 'POST',
                        data: mydata,
                        processData: false,
                        contentType: false,
                        // alert("ok");
                        success: function(response) {
                            if (response.status == 1) {
                                Swal.fire({
                                    icon: "success",
                                    title: response.message,
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                                setTimeout(() => {
                                    window.location.reload(true);

                                }, 1000);

                            } else if (response.status == 2) {
                                Swal.fire({
                                    icon: "error",
                                    title: response.message,
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                            } else if (response.status == 0) {
                                Swal.fire({
                                    icon: "error",
                                    title: response.message,
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                            } else {
                                alert(response);
                            }
                        }
                    });
                });
            });


            // Invoice


            $(document).ready(function() {
                $(document).on('submit', '#invoicedata', function(e) {
                    e.preventDefault();
                    var mydata = new FormData(this);

                    $.ajax({
                        url: "{{ route('pos_userinfo.update', $user->invoice_number) }}",
                        method: 'POST',
                        data: mydata,
                        processData: false,
                        contentType: false,
                        // alert("ok");
                        success: function(response) {
                            if (response.status == 1) {
                                Swal.fire({
                                    icon: "success",
                                    title: response.message,
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });

                                setTimeout(function() {
                                    window.location.href = "{{ route('pos_userinfo.index') }}";
                                },1000)
                            } else if (response.status == 2) {
                                Swal.fire({
                                    icon: "error",
                                    title: response.message,
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });

                            }else if (response.status == 3) {
                                Swal.fire({
                                    icon: "error",
                                    title: response.message,
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                            }
                             else {
                                alert(response);
                            }
                        }
                    });
                });
            });




            // Quantity Change


            $(document).on('change', '.pqty', function(e) {
                e.preventDefault();

                let element = $(this);
                let itemId = element.data('item-id');
                let quantity = element.val();
                let unitPrice = element.data('unit-price');
                let mydata = {
                    _method: "PUT",
                    _token: "{{ csrf_token() }}",
                    order_quantity: quantity,
                    order_unit_price: unitPrice
                };
                // alert(67);
                $.ajax({
                    url: "{{ route('pos_orderinfo.update', '') }}/" + itemId,
                    method: 'POST',
                    data: mydata,
                    success: function(response) {
                        if (response.status == 1) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                            // window.location.reload(true);
                        } else if (response.status == 2) {
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });


            // Delete POS Product


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
                                // alert("ok");
                                swalWithBootstrapButtons.fire({
                                    title: "Deleted!",
                                    text: "The product has been deleted.",
                                    icon: "success"
                                });
                            } else if (
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons.fire({
                                    title: "Cancelled",
                                    text: "The product is safe.",
                                    icon: "error"
                                });
                            }
                        });
                    });
                });
            });
        </script>
    @endsection
