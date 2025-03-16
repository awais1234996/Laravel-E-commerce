@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Role Table</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <a href="{{ route('role.create') }}" class="btn btn-primary form-control">Add</a>
                    <div class="card-box">
                        <div class="table-responsive table-hover">
                            <table class="table mb-0 new-patient-table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Role Name</th>
                                        <th>Role Access</th>
                                        <th>Category</th>
                                        <th>Sub-Category</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Product</th>
                                        <th>Orders</th>
                                        <th>POS</th>
                                        <th>Contact</th>
                                        <th>User Management</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        @foreach ($role as $item)
                                    </tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->role_name }}</td>
                                    <td>{{ $item->role_access }}</td>
                                    <td>
                                        <input type="checkbox" {{ $item->category == 'Category' ||$item->role_access=='all' ? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->subcategory == 'SubCategory' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->supplier == 'Supplier' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->quantity == 'Quantity' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->products == 'Product' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>

                                        <input type="checkbox" {{ $item->orders == 'Orders' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->pos == 'POS' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->contact == 'Contact' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                            {{ $item->user_management == 'User-Management' ||$item->role_access=='all'? 'checked' : 'disabled' }}>
                                    </td>

                                    <td>
                                        <a href="{{ route('role.edit', $item->id) }}"
                                            class="btn btn-success btn-success-update"><i class="fa-solid fa-pencil"></i>
                                            Update</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('role.destroy', $item->id) }}" method="POST">
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
                        {{ $role->links('pagination::bootstrap-5') }}
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
