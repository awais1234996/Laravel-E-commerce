@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Product Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <a href="{{ route('product.index') }}" class="btn btn-primary form-control mb-3">View Products</a>
                    <div class="card-box">
                        <h4 class="card-title">Add Product Here!</h4>
                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data"
                            id="formdata">
                            @csrf
                            @method('POST')

                            <!-- Category -->
                            <div class="form-group">
                                <label><b>Category</b></label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- SubCategory -->
                            <div class="form-group">
                                <label><b>SubCategory</b></label>
                                <select name="subcategory_id" class="form-control" id="subcategory_id">
                                    <option value="">Select SubCategory</option>
                                </select>
                                <span class="text-danger">
                                    @error('subcategory_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>




                            <!-- Supplier -->
                            <div class="form-group">
                                <label><b>Supplier</b></label>
                                <select name="supplier" class="form-control">
                                    <option value="">Select Supplier</option>
                                    @foreach ($supplier as $sup)
                                        <option value="{{ $sup->id }}">{{ $sup->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('supplier')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Product Name -->
                            <div class="form-group">
                                <label><b>Product Name</b></label>
                                <input type="text" name="product_name" value="{{ old('product_name') }}"
                                    class="form-control @error('product_name') is-invalid @enderror"
                                    placeholder="Enter product name">
                                <span class="text-danger">
                                    @error('product_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Product Description -->
                            <div class="form-group">
                                <label><b>Product Description</b></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter product description" rows="3">{{ old('description') }}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Short Description -->
                            <div class="form-group">
                                <label><b>Short Description</b></label>
                                <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Enter short description" rows="3">{{ old('short_description') }}</textarea>
                                <span class="text-danger">
                                    @error('short_description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Product Code -->
                            <div class="form-group">
                                <label><b>Product Code</b></label>
                                <input type="number" name="product_code" value="{{ old('product_code') }}"
                                    class="form-control @error('product_code') is-invalid @enderror"
                                    placeholder="Enter product code">
                                <span class="text-danger">
                                    @error('product_code')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Product Stock -->
                            <div class="form-group">
                                <label><b>Product Stock</b></label>
                                <input type="number" name="product_stock" value="{{ old('product_stock') }}"
                                    class="form-control @error('product_stock') is-invalid @enderror"
                                    placeholder="Enter stock quantity">
                                <span class="text-danger">
                                    @error('product_stock')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Unit Price -->
                            <div class="form-group">
                                <label><b>Unit Price</b></label>
                                <input type="text" name="unit_price" value="{{ old('unit_price') }}"
                                    class="form-control @error('unit_price') is-invalid @enderror"
                                    placeholder="Enter unit price">
                                <span class="text-danger">
                                    @error('unit_price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Quantity -->
                            <div class="form-group">
                                <label><b>Quantity</b></label>
                                <select name="quantity" class="form-control">
                                    <option value="">Select Quantity</option>
                                    @foreach ($quantity as $qty)
                                        <option value="{{ $qty->id }}">{{ $qty->quantity }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Total Price</b></label>
                                <input type="text" name="total_price" value="{{ old('total_price') }}"
                                    class="form-control @error('total_price') is-invalid @enderror"
                                    placeholder="Enter Total price">
                                <span class="text-danger">
                                    @error('total_price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <!-- Product Image -->
                            <div class="form-group">
                                <label><b>Product Images</b></label>
                                <input type="file" name="product_image[]" multiple
                                    class="form-control @error('product_image') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('product_image')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label><b>Status</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="online"
                                        class="form-check-input @error('status') is-invalid @enderror"
                                        {{ old('status') === 'online' ? 'checked' : '' }}>
                                    <label class="form-check-label">Online</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="offline"
                                        class="form-check-input @error('status') is-invalid @enderror"
                                        {{ old('status') === 'offline' ? 'checked' : '' }}>
                                    <label class="form-check-label">Offline</label>
                                </div><br>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
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
                        } else if (response.status == 3) {
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
                        } else if (response.status == 4) {
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


        $(document).ready(function() {
            // When the category is selected
            $('#category_id').change(function() {
                var category_id = $(this).val();

                if (category_id) {
                    // Make an AJAX request to get subcategories
                    $.ajax({
                        url: '/subcategories/' + category_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var subcategorySelect = $('#subcategory_id');
                            subcategorySelect.empty(); // Clear the subcategory dropdown

                            subcategorySelect.append(
                                '<option value="">Select SubCategory</option>'
                                ); // Add default option

                            // Populate subcategories
                            $.each(data, function(key, subcategory) {
                                subcategorySelect.append('<option value="' + subcategory
                                    .id + '">' + subcategory.subcategory_name +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory_id').empty(); // If no category is selected, clear subcategories
                    $('#subcategory_id').append('<option value="">Select SubCategory</option>');
                }
            });
        });
    </script>
@endsection
