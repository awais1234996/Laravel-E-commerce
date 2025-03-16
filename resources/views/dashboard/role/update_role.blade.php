@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Update Role Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="card-box">
                        <h4 class="card-title">Update Role Here!</h4>
                        <form id="formdata" action="{{ route('role.update', $sql->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mt-3">
                                <div class="col-lg-12 form-group">
                                    <label class="form-label">Role Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" value="{{ $sql->role_name }}" name="role_name" placeholder="Enter Role Name"
                                        type="text">
                                    <span id="role_name" style="color:red;"></span>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="form-label">Role Sccess<span class="tx-danger">*</span></label>
                                    <select name="role_access" class="form-control" onchange="show();" id="select_access">
                                        <option value="{{ $sql->role_access }}" selected>{{ $sql->role_access }}</option>
                                        <option value="all">All</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                    <span id="role_access" style="color:red"></span>
                                </div>
                                <div class="col-lg-12 form-group" style="display:none;" id="custom_access">
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="category" type="checkbox" {{ $sql->category=='Category' ? 'checked' : '' }}
                                                value="Category"><span>Category</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="subcategory" type="checkbox" {{ $sql->subcategory=='SubCategory' ? 'checked' : '' }}
                                                value="SubCategory"><span>Subcategory</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="supplier" type="checkbox" {{ $sql->supplier=='Supplier' ? 'checked' : '' }}
                                                value="Supplier"><span>Supplier</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="quantity" type="checkbox" {{ $sql->quantity=='Quantity' ? 'checked' : '' }}
                                                value="Quantity"><span>Quantity</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="product" type="checkbox" {{ $sql->products=='Product' ? 'checked' : '' }}
                                                value="Product"><span>Product</span></label>
                                    </div>

                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="orders" type="checkbox" {{ $sql->orders=='Orders' ? 'checked' : '' }}
                                                value="Orders"><span>Orders</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="pos" {{ $sql->pos=='POS' ? 'checked' : '' }} type="checkbox"
                                                value="POS"><span>POS</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="contact" type="checkbox" {{ $sql->contact=='Contact' ? 'checked' : '' }}
                                                value="Contact"><span>Contact</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="user_management" type="checkbox" {{ $sql->user_management=='User-Management' ? 'checked' : '' }}
                                                value="User-Management"><span>User Management</span></label>
                                    </div>

                                </div>
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
        function show() {
            var select_access = document.getElementById("select_access");
            var custom_access = document.getElementById("custom_access");
            custom_access.style.display = select_access.value == "custom" ?
                'block' : 'none';
        }

        $(document).ready(function() {
            $(document).on('submit', '#formdata', function(e) {
                e.preventDefault();
                var mydata = new FormData(formdata);
                $.ajax({
                    url: "{{ route('role.update', $sql->id) }}",
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
                            $("#formdata").trigger("reset")
                            setTimeout(function() {
                                window.location.href = "{{ route('role.index') }}";
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
