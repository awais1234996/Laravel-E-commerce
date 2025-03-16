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
                    <div class="card-box">
                        <h4 class="card-title">Update Supplier Here!</h4>
                        <form action="{{ route('supplier.update', $sql->id) }}" id="formdata" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><b>supplier Name</b></label>
                                <input type="text" value="{{ $sql->supplier_name }}" name="supplier_name"
                                    value="{{ $sql->supplier_name }}"
                                    class="form-control @error('supplier_name') is-invalid

                                    @enderror"
                                    placeholder="Enter supplier Name">
                                <span class="text-danger">
                                    @error('supplier_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Supplier Email</b></label>
                                <input type="text" value="{{ $sql->supplier_email }}" name="supplier_email"
                                    value="{{ $sql->supplier_email }}"
                                    class="form-control @error('supplier_email') is-invalid

                                    @enderror"
                                    placeholder="Enter supplier email">
                                <span class="text-danger">
                                    @error('supplier_email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Supplier CNIC</b></label>
                                <input type="number" value="{{ $sql->supplier_cnic }}" name="supplier_cnic"
                                    value="{{ $sql->supplier_cnic }}"
                                    class="form-control @error('supplier_cnic') is-invalid

                                    @enderror"
                                    placeholder="Enter supplier cnic">
                                <span class="text-danger">
                                    @error('supplier_cnic')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
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
                    url: "{{ route('supplier.update', $sql->id) }}",
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
                            setTimeout(function(){

                                window.location.href = "{{ route('supplier.index') }}";
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
                        } else {
                            alert(response);
                        }
                    }
                });
            });
        });
    </script>
@endsection
