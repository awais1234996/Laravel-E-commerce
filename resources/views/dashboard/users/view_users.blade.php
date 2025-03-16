@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Users Table</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <a href="{{ route('users.create') }}" class="btn btn-primary form-control">Add</a>
                    <div class="card-box">
                        <div class="table-responsive table-hover">
                            <table class="table mb-0 new-patient-table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Postal Code</th>
                                        <th>Address</th>
                                        <th>Invoice</th>
                                        <th>Status</th>
                                        <th>Update Status</th>
                                        <th>Delete</th>
                                        @foreach ($user as $sql)
                                    </tr>
                                    <td>{{ $sql->id }}</td>
                                    <td>{{ $sql->user_name}}</td>
                                    <td>{{ $sql->user_email}}</td>
                                    <td>{{ $sql->user_phone}}</td>
                                    <td>{{ $sql->user_country}}</td>
                                    <td>{{ $sql->user_state}}</td>
                                    <td>{{ $sql->user_city}}</td>
                                    <td>{{ $sql->user_postal_code}}</td>
                                    <td>{{ $sql->user_address }}</td>
                                    <td>{{ $sql->user_invoice }}</td>
                                    <td>{{ $sql->user_status }}</td>
                                    <td>
                                        @if ($sql->user_status == 'Pending')
                                            <a href="{{ route('users.show', $sql->id) }}"
                                                class="btn btn-warning">
                                                Confirm
                                            </a>
                                        @elseif ($sql->user_status == 'Completed')
                                            <a href="{{ route('users.show', $sql->id) }}"
                                                class="btn btn-info ">
                                                Pending
                                            </a>
                                        @endif


                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', $sql->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-danger-delete delete-btn"><i
                                                    class="fa-solid fa-trash-can"></i> Delete</button>
                                        </form>
                                    </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><br><br>
                        {{ $user->links('pagination::bootstrap-5') }}
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
