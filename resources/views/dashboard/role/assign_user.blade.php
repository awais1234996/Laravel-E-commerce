@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Assign User Role Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <a href="{{ route('assignRole.index') }}" class="btn btn-primary form-control">View</a>
                    <div class="card-box">
                        <form action="{{ route('assignRole.store') }}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="catname"
                                        name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" id="catname"
                                        name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="catname"
                                                value="{{ old('password') }}" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label>Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('confrim_password') is-invalid @enderror"
                                                value="{{ old('confrim_password') }}" id="catname"
                                                name="confirm_password">
                                            @error('confirm_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="mb-3 row ">
                                        <label class="col-6 col-form-label fw-bold">Roles</label>
                                        <div class="col-12 ">


                                            <select name="role" class="form-control @error('role')is-invalid @enderror">

                                                <option value="">Select Role</option>
                                                @foreach (DB::table('roles')->get() as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->role_name }}
                                                    </option>
                                                @endforeach


                                            </select><br>
                                            <span class="text-danger">
                                                @error('role')
                                                    {{ $message }}
                                                @enderror
                                            </span>


                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary ">
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
                    url: "{{ route('assignRole.store') }}",
                    method: 'POST',
                    data: mydata,
                    contentType: false,
                    processData: false,
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
