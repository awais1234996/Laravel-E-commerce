@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Reply Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="card-box">
                        <h4 class="card-title">Reply To User:- <h2 class="text-center text-primary">{{ $sql->name }}</h2></h4>
                        <form action="{{ route('contact.email') }}" id="formdata" method="HEAD">
                            @csrf
                            @method('HEAD')

                            <div class="card-body">

                                <div class="form-group">
                                    <label>User Email</label>
                                    <input type="email" class="form-control" value="{{ $sql->email }}" id="remail"
                                        name="replyemail" readonly>
                                    <br>

                                </div>

                                <div class="form-group mb-0">
                                    <label>Subject</label>
                                    <textarea class="form-control" id="rsub" name="subject"></textarea>
                                    <br>

                                </div>
                                <div class="form-group mb-0">
                                    <label>Message</label>
                                    <textarea class="form-control" id="rmsg" name="message"></textarea>
                                    <br>

                                </div>
                                <input type="submit" class="btn btn-primary ">
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @if (Session::has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ Session('success') }}"
        });
    </script>
@elseif (Session::has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            title: "{{ Session('error') }}"
        });
    </script>
@endif
@endsection
