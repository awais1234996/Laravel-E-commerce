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

                    <div class="card-box">
                        <form action="{{ route('assignRole.update', $sql->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" value="{{$sql->name}}"
                                        class="form-control @error('name') is-invalid @enderror" id="catname"
                                        name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" value="{{ $sql->email }}"
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
                                                value="{{ $sql->password }}" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label>Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('confrim_password') is-invalid @enderror"
                                                value="{{ $sql->password }}" id="catname"
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

                                                <option value="{{ $sql->role_id }}">{{ $sql->role?->role_name }}</option>
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

   
@endsection
