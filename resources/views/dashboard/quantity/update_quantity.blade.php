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
                    <div class="card-box">
                        <h4 class="card-title">Update Quantity Here!</h4>
                        <form action="{{ route('quantity.update', $sql->id) }}" id="formdata" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><b>Quantity</b></label>
                                <input type="number" value="{{ $sql->quantity }}" name="quantity"
                                    value="{{ $sql->quantity }}"
                                    class="form-control @error('quantity') is-invalid

                                    @enderror"
                                    placeholder="Enter quantity Name">
                                <span class="text-danger">
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Quantity Type</b></label>
                                <input type="text" value="{{ $sql->quantity_type }}" name="quantity_type"
                                    value="{{ $sql->quantity_type }}"
                                    class="form-control @error('quantity_type') is-invalid

                                    @enderror"
                                    placeholder="Enter quantity email">
                                <span class="text-danger">
                                    @error('quantity_type')
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
                    url: "{{ route('quantity.update', $sql->id) }}",
                    method: 'POST',
                    data: mydata,
                    processData: false,
                    contentType: false,
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
                            setTimeout(function(){

                                window.location.href = "{{ route('quantity.index') }}";
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
