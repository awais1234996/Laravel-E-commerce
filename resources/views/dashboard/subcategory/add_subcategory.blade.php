@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">SubCategory Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <a href="{{ route('subcategory.index') }}" class="btn btn-primary form-control">View</a>
                    <div class="card-box">
                        <h4 class="card-title">Add SubCategory Here!</h4>
                        <form action="{{ route('subcategory.store') }}" method="POST" id="formdata">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label><b>Category Name</b></label>
                                <select name="category_id" id=""
                                    class="form-control @error('category_id') is-invalid @enderror"
                                    placeholder="Select Category">
                                    <option value="{{ old('category_id') }}">Select Category</option>
                                    @foreach ($cat as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>SubCategory Name</b></label>
                                <input type="text" value="{{ old('subcategory_name') }}" name="subcategory_name"
                                    class="form-control @error('subcategory_name') is-invalid @enderror"
                                    placeholder="Enter Category Name">
                                <span class="text-danger">
                                    @error('subcategory_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>Description</b></label>
                                <textarea name="description" id="" cols="30" rows="4"
                                    class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description') }}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="text-right">
                                <input type="submit" class="btn btn-primary" value="Submit">
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
                // alert(mydata)
                $.ajax({
                    url: "{{ route('subcategory.store') }}",
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
