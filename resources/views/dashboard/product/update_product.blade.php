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
                    <a href="{{ route('product.index') }}" class="btn btn-primary form-control">View</a>
                    <div class="card-box">
                        <h4 class="card-title">Update Product Here!</h4>
                        <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data"
                            id="formdata">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><b>Category</b></label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="{{ $product->category->id }}">{{ $product->category->category_name }}</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>SubCategory</b></label>
                                <select name="subcategory_id" id="" class="form-control">
                                    <option value="{{ $product->subcategory->id }}">{{$product->subcategory->subcategory_name}}</option>
                                    @foreach ($subcategory as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('subcategory_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Supplier</b></label>
                                <select name="supplier" id="" class="form-control">
                                    <option value="{{ $product->supplier->id ?? '' }}">
                                        {{ $product->supplier->supplier_name ?? 'No Supplier' }}
                                    </option>

                                    @foreach ($supplier as $supplierItem)
                                        <option value="{{ $supplierItem->id }}">{{ $supplierItem->supplier_name }}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger">
                                    @error('supplier')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>Product Name</b></label>
                                <input type="text" value="{{ $product->product_name }}" name="product_name"
                                    class="form-control @error('product_name') is-invalid @enderror"
                                    placeholder="Enter product email">
                                <span class="text-danger">
                                    @error('product_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>Product Description</b></label>
                                <textarea name="description" id=""
                                    class="form-control @error('description') is-invalid

                             @enderror" cols="30"
                                    rows="3">{{ $product->description }}</textarea>
                                <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label><b>Short Description</b></label>
                                <textarea name="short_description" id=""
                                    class="form-control @error('short_description') is-invalid

                             @enderror" cols="30"
                                    rows="3">{{ $product->short_description }}</textarea>
                                <span class="text-danger">
                                    @error('short_description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Product Code</b></label>
                                <input type="number" name="product_code" id=""
                                    class="form-control @error('product_code') is-invalid

                             @enderror"
                                    value="{{ $product->product_code }}"></input>
                                <span class="text-danger">
                                    @error('product_code')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Product Stock</b></label>
                                <input type="number" name="product_stock" id=""
                                    class="form-control @error('product_stock') is-invalid

                             @enderror"
                                    value="{{ $product->product_stock }}"></input>
                                <span class="text-danger">
                                    @error('product_stock')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Product Unit Price</b></label>
                                <input type="text" name="unit_price" id=""
                                    class="form-control @error('unit_price') is-invalid

                             @enderror"
                                    value="{{ $product->unit_price }}"></input>
                                <span class="text-danger">
                                    @error('unit_price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Quantity</b></label>
                                <select name="quantity" id="" class="form-control">
                                    <option value="{{ $product->quantity->id ?? '' }}">{{ $product->quantity->name ?? 'No Quantity' }}</option>
                                    @foreach ($quantity as $quantity)
                                        <option value="{{ $quantity->id }}">{{ $quantity->quantity_type }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Product Total Price</b></label>
                                <input type="text" name="total_price" id=""
                                    class="form-control @error('total_price') is-invalid

                             @enderror"
                                    value="{{ $product->total_price }}"></input>
                                <span class="text-danger">
                                    @error('total_price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Product Image</b></label>
                                <input type="file" name="product_image[]" multiple id=""
                                    class="form-control @error('product_image') is-invalid

                             @enderror"></input>
                                <span class="text-danger">
                                    @error('product_image')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label><b>Status</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="online"
                                        class="form-check-input @error('status') is-invalid @enderror"
                                        {{ $product->status === 'online' ? 'checked' : '' }}>
                                    <label class="form-check-label">Online</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" value="offline"
                                        class="form-check-input @error('status') is-invalid @enderror"
                                        {{ $product->status === 'offline' ? 'checked' : '' }}>
                                    <label class="form-check-label">Offline</label>
                                </div>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>




                            <div class="text-right">
                                <input type="submit" value="Submit" class="btn btn-primary form" />
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
                    url: "{{ route('product.update',$product->id) }}",
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
                            setTimeout(function() {

                                window.location.href = "{{ route('product.index') }}";
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
