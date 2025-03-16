@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Category Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="card-title">Update Category Here!</h4>
                        <form action="{{ route('category.update', $sql->id) }}" id="formdata" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><b>Category Name</b></label>
                                <input type="text" value="{{ $sql->category_name }}" name="category_name"
                                    value="{{ $sql->category_name }}"
                                    class="form-control @error('category_name') is-invalid

                                    @enderror"
                                    placeholder="Enter Category Name">
                                <span class="text-danger">
                                    @error('category_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>Description</b></label>
                                <textarea name="description" id="" cols="30" rows="4"
                                    class="form-control @error('description') is-invalid

                                @enderror"> {{ $sql->description }}</textarea>
                            </div>
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                    url: "{{ route('category.update', $sql->id) }}",
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

                                window.location.href = "{{ route('category.index') }}";
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
