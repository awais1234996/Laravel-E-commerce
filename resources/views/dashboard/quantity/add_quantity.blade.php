@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Quantity Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <a href="{{ route('quantity.index') }}" class="btn btn-primary form-control">View</a>
                    <div class="card-box">
                        <h4 class="card-title">Add Quantity Here!</h4>
                        <form action="{{ route('quantity.store') }}" method="post" id="formdata">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label><b>Quantity</b></label>
                                <input type="number" value="{{ old('quantity') }}" name="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    placeholder="Enter quantity Name">
                                <span class="text-danger">
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Quantity Type</b></label>
                                <input type="text" value="{{ old('quantity_type') }}" name="quantity_type"
                                    class="form-control @error('quantity_type') is-invalid @enderror"
                                    placeholder="Enter quantity email">
                                <span class="text-danger">
                                    @error('quantity_type')
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
                    url: "{{ route('quantity.store') }}",
                    method: 'POST',
                    data: mydata,
                    contentType: false,
                    processData: false,
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
