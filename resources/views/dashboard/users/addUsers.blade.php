@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Users Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <a href="{{ route('users.index') }}" class="btn btn-primary form-control mb-3">View Users</a>
                    <div class="card-box">
                        <h4 class="card-title">Add Users Here!</h4>
                        <form action="{{ route('users.store') }}" method="post"  id="formdata">
                            @csrf
                            @method('POST')


                            <div class="form-group">
                                <label><b>User Name</b></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Name">
                                <span class="text-danger">
                                    @error('name') {{ $message }} @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>User Email</b></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter Email">
                                <span class="text-danger">
                                    @error('email') {{ $message }} @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>User Phone</b></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter Phone Number">
                                <span class="text-danger">
                                    @error('phone') {{ $message }} @enderror
                                </span>
                            </div>


                            <div class="form-group">
                                <label><b>Country</b></label>
                                <input type="text" name="country" value="{{ old('country') }}"
                                    class="form-control @error('country') is-invalid @enderror"
                                    placeholder="Enter Country Name">
                                <span class="text-danger">
                                    @error('country') {{ $message }} @enderror
                                </span>
                            </div>


                            <div class="form-group">
                                <label><b>State</b></label>
                                <input type="text" name="state" value="{{ old('state') }}"
                                    class="form-control @error('state') is-invalid @enderror"
                                    placeholder="Enter State Name">
                                <span class="text-danger">
                                    @error('state') {{ $message }} @enderror
                                </span>
                            </div>


                            <div class="form-group">
                                <label><b>City</b></label>
                                <input type="text" name="city" value="{{ old('city') }}"
                                    class="form-control @error('city') is-invalid @enderror"
                                    placeholder="Enter City Name">
                                <span class="text-danger">
                                    @error('city') {{ $message }} @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>Postal Code</b></label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                    class="form-control @error('postal_code') is-invalid @enderror"
                                    placeholder="Enter Postal Code">
                                <span class="text-danger">
                                    @error('postal_code') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Address</b></label>
                                <textarea name="address" class="form-control @error('postal_code') is-invalid @enderror" placeholder="Enter Address" id=""></textarea>
                                <span class="text-danger">
                                    @error('address') {{ $message }} @enderror
                                </span>
                            </div>
                         



                            <!-- Submit -->
                            <div class="text-right">
                                <input type="submit" value="Submit" class="btn btn-primary">
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
                    url: "{{ route('product.store') }}",
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
                                icon: "warning",
                                title: response.message,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
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
                        }else if (response.status == 3) {
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
                        }else if (response.status == 4) {
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                        }else {
                            alert(response);
                        }
                    }
                });
            });
        });
    </script>
@endsection
