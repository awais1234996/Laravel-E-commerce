@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Category Table</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <a href="{{ route('category.create') }}" class="btn btn-primary form-control">Add</a>
                    <div class="card-box">
                        <div class="table-responsive table-hover">
                            <table class="table mb-0 new-patient-table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        @foreach ($sql as $item)
                                    </tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $item->id) }}"
                                            class="btn btn-success btn-success-update"><i class="fa-solid fa-pencil"></i> Update</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('category.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-danger-delete delete-btn"><i class="fa-solid fa-trash-can"></i> Delete</button>
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
