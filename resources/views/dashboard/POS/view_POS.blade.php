@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">POS Table</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <a href="{{ route('AddPOSProduct.create') }}" class="btn btn-primary form-control mb-3">Add POS</a>
                    <div class="card-box">
                        <div class="table-responsive table-hover">
                            <table class="table mb-0 new-patient-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>User Contact</th>
                                        <th>Invoice#</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Verify Status</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sql as $POS)
                                        <tr>
                                            <td>{{ $POS->id }}</td>
                                            <td>{{ $POS->user_name }}</td>
                                            <td>{{ $POS->contact }}</td>
                                            <td>{{ $POS->invoice_number }}</td>
                                            <td>{{ $POS->total_cash }}</td>
                                            <td>{{ $POS->status }}</td>


                                            <td>
                                                @if ($POS->status == 'Pending')
                                                    <a href="{{ route('pos_userinfo.show', $POS->id) }}"
                                                        class="btn btn-warning">
                                                        Confirm
                                                    </a>
                                                @elseif ($POS->status == 'Completed')
                                                    <a href="{{ route('pos_userinfo.show', $POS->id) }}"
                                                        class="btn btn-info ">
                                                        Pending
                                                    </a>
                                                @endif


                                            </td>
                                            <td>
                                                <a href="{{ route('pos_userinfo.edit', $POS->invoice_number) }}"
                                                    class="btn btn-success btn-success-update">
                                                    <i class="fa-solid fa-pencil"></i> Update
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('pos_userinfo.destroy', $POS->id) }}"
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
                                </tbody>
                            </table>
                        </div><br><br>
                        {{ $sql->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('success') }}",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('error') }}",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @endif
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
                                text: "The POS has been deleted.",
                                icon: "success"
                            });
                        } else if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: "Cancelled",
                                text: "The POS is safe.",
                                icon: "error"
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
