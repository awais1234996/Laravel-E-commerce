@extends('dashboard.master_layout.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Role Form</h4>
                </div>
            </div>
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <a href="{{ route('role.index') }}" class="btn btn-primary form-control">View</a>
                    <div class="card-box">
                        <h4 class="card-title">Add Role Here!</h4>
                        <form id="formdata" action="{{ route('role.store') }}" method="POST">
                            @csrf

                            <div class="row mt-3">
                                <div class="col-lg-12 form-group">
                                    <label class="form-label">Role Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="role_name" placeholder="Enter Role Name"
                                        type="text">
                                    <span id="role_name" style="color:red;"></span>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="form-label">Role Sccess<span class="tx-danger">*</span></label>
                                    <select name="role_access" class="form-control" onchange="show();" id="select_access">
                                        <option value="" selected>Select Type Access</option>
                                        <option value="all">All</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                    <span id="role_access" style="color:red"></span>
                                </div>
                                <div class="col-lg-12 form-group" style="display:none;" id="custom_access">
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="category" type="checkbox"
                                                value="Category"><span>Category</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="subcategory" type="checkbox"
                                                value="SubCategory"><span>Subcategory</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="supplier" type="checkbox"
                                                value="Supplier"><span>Supplier</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="quantity" type="checkbox"
                                                value="Quantity"><span>Quantity</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="product" type="checkbox"
                                                value="Product"><span>Product</span></label>
                                    </div>

                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="orders" type="checkbox"
                                                value="Orders"><span>Orders</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="pos" type="checkbox"
                                                value="POS"><span>POS</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="contact" type="checkbox"
                                                value="Contact"><span>Contact</span></label>
                                    </div>
                                    <div class="col-lg-12 mg-t-20 mg-lg-t-0 mb-2">
                                        <label class="ckbox"><input name="user_management" type="checkbox"
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
                    url: "{{ route('role.store') }}",
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
