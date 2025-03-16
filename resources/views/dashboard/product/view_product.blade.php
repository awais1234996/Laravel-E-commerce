@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Product Table</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <a href="{{ route('product.create') }}" class="btn btn-primary form-control mb-3">Add Product</a>
                    <div class="card-box">
                        <div class="table-responsive table-hover ">
                            <table id="mydata"></table>
                            {{-- {{ $dataTable->table() }} --}}
                        </div><br><br>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#mydata').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        title: 'ID',
                    },
                    {
                        data: 'category.name',
                        name: 'category.name',
                        title: 'Category'
                    },
                    {
                        data: 'subcategory.name',
                        name: 'subcategory.name',
                        title: 'Subcategory'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name',
                        title: 'Product Name'
                    },
                    {
                        data: 'supplier.name',
                        name: 'supplier.name',
                        title: 'Supplier'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code',
                        title: 'Product Code'
                    },
                    {
                        data: 'product_stock',
                        name: 'product_stock',
                        title: 'Stock'
                    },
                    {
                        data: 'unit_price',
                        name: 'unit_price',
                        title: 'Unit Price'
                    },
                    {
                        data: 'quantity.amount',
                        name: 'quantity.amount',
                        title: 'Quantity'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price',
                        title: 'Total Price'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        title: 'Status'
                    },
                    {
                        data: 'product_image',
                        name: 'product_image',
                        title: 'Product Images',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            let images = JSON.parse(
                            data);
                            let html = '';
                            images.forEach(function(image) {
                                html +=
                                    `<img src="/product_images/${image}" alt="Product Image" style="width:50px;height:50px;border-radius:50%;margin: 2px;">`;
                            });
                            return html;
                        }
                    },

                    {
                        data: 'actions',
                        name: 'actions',
                        title: 'Actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });


        // Delete


        $(document).on('click', '.delete-btn', function() {
            let productId = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/product/${productId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your product has been deleted.",
                                    icon: "success",
                                    confirmButtonColor: "#3085d6"
                                });

                                $('#mydata').DataTable().ajax.reload();
                            }
                        },

                    });
                } else {

                    Swal.fire({
                        title: "Error!",
                        text: "Cancelled.",
                        icon: "error",
                        confirmButtonColor: "#3085d6"
                    });
                }
            });
        });
    </script>


    {{-- <script>
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
    </script> --}}
@endsection
