@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Supplier Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <a href="{{ route('supplier.index') }}" class="btn btn-primary form-control">View</a>
                    <div class="card-box">
                        <h4 class="card-title">Add Supplier Here!</h4>
                        <form action="{{ route('supplier.store') }}" method="post" id="formdata">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label><b>Supplier Name</b></label>
                                <input type="text" value="{{ old('supplier_name') }}" name="supplier_name"
                                    class="form-control @error('supplier_name') is-invalid @enderror"
                                    placeholder="Enter supplier Name">
                                <span class="text-danger">
                                    @error('supplier_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Supplier Email</b></label>
                                <input type="text" value="{{ old('supplier_email') }}" name="supplier_email"
                                    class="form-control @error('supplier_email') is-invalid @enderror"
                                    placeholder="Enter supplier email">
                                <span class="text-danger">
                                    @error('supplier_email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Supplier CNIC</b></label>
                                <input type="number" value="{{ old('supplier_cnic') }}" name="supplier_cnic"
                                    class="form-control @error('supplier_cnic') is-invalid @enderror"
                                    placeholder="Enter supplier cnic">
                                <span class="text-danger">
                                    @error('supplier_cnic')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class="text-right">
                                <input type="submit" value="Submit" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#formdata', function(e) {
                e.preventDefault();
                var mydata = new FormData(formdata);
                $.ajax({
                    url: "{{ route('supplier.store') }}",
                    method: 'POST',
                    data: mydata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 0) {

                            Swal.fire({
                                icon: "warning",
                                title: response.message,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });

                        } else if (response.status == 1) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                            $("#formdata").trigger("reset")
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
                        } else {
                            alert(response);
                        }
                    }
                });
            });
        });
    </script>
@endsection
