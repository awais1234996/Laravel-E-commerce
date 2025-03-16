@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Orders Table</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12">

                    <div class="card-box">
                        <div class="table-responsive table-hover">
                            <table class="table mb-0 new-patient-table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                        <th>Product Total Price</th>
                                        <th>Order Email</th>
                                        <th>Order image</th>
                                        <th>Order Invoice</th>
                                        <th>Order Status</th>
                                        <th>Order Payment</th>
                                        <th>Update Status</th>
                                        <th>Delete</th>
                                    </tr>

                                    @foreach ($order as $sql)
                                        <tr>
                                            <td>{{ $sql->id }}</td>
                                            <td>{{ $sql->order_name }}</td>
                                            <td>{{ $sql->order_code }}</td>
                                            <td>{{ $sql->order_price }}</td>
                                            <td>{{ $sql->order_quantity }}</td>
                                            <td>{{ $sql->order_total_price }}</td>
                                            <td>{{ $sql->order_email }}</td>
                                            <td></td>
                                            <td>{{ $sql->order_invoice }}</td>
                                            <td>{{ $sql->order_status }}</td>
                                            <td> @php
                                                $ick = '';
                                                if ($sql->order_status == 'Completed') {
                                                    $ick = 'checked';
                                                } else {
                                                    $ick = '';
                                                }
                                            @endphp


                                                <input type="checkbox" <?php echo $ick; ?> class="chek" Name="checkbox">
                                            </td>
                                            </td>
                                            <td>
                                                @if ($sql->order_status == 'Pending')
                                                    <a href="{{ route('orders.show', $sql->id) }}" class="btn btn-warning">
                                                        Confirm
                                                    </a>
                                                @elseif ($sql->order_status == 'Completed')
                                                    <a href="{{ route('orders.show', $sql->id) }}" class="btn btn-info ">
                                                        Pending
                                                    </a>
                                                @endif


                                            </td>
                                            <td>
                                                <form action="{{ route('orders.destroy', $sql->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-danger-delete delete-btn"><i
                                                            class="fa-solid fa-trash-can"></i> Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><br><br>
                        {{ $order->links('pagination::bootstrap-5') }}
                    </div>
                </div>

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
    </script>
@endsection
